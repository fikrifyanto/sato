<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function midtrans(Request $request): JsonResponse
    {
        $payload = $request->all();

        // Validate signature
        $serverKey = config('midtrans.server_key');

        $expectedSignature = hash(
            'sha512',
            $payload['order_id']
            . $payload['status_code']
            . $payload['gross_amount']
            . $serverKey
        );

        if ($payload['signature_key'] !== $expectedSignature) {
            Log::warning('Midtrans invalid signature', $payload);
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // Get order
        $order = Order::where('code', $payload['order_id'])->first();

        if (!$order) {
            Log::warning('Order not found', $payload);
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Mapping status
        $transactionStatus = $payload['transaction_status'];
        $fraudStatus = $payload['fraud_status'] ?? null;

        $orderStatus = match ($transactionStatus) {
            'capture' => $fraudStatus === 'accept'
                ? OrderStatus::Completed
                : OrderStatus::Processing,

            'settlement' => OrderStatus::Completed,
            'deny', 'cancel', 'expire', 'refund', 'partial_refund' => OrderStatus::Cancelled,

            default => OrderStatus::Pending,
        };

        // Update order payment
        $order->lastOrderPayment()->update([
            'status' => $orderStatus,
            'payment_id' => $payload['transaction_id'] ?? null,
            'payment_type' => $payload['payment_type'] ?? null,
            'transaction_time' => $payload['transaction_time'] ?? null,
            'settlement_time' => $payload['settlement_time'] ?? null,
            'expiry_time' => $payload['expiry_time'] ?? null,
            'amount' => $payload['gross_amount'] ?? null,
            'currency' => $payload['currency'] ?? 'IDR',
            'va_numbers' => $payload['va_numbers'] ?? null,
            'permata_va_number' => $payload['permata_va_number'] ?? null,
            'bill_key' => $payload['bill_key'] ?? null,
            'biller_code' => $payload['biller_code'] ?? null,
            'fraud_status' => $fraudStatus,
            'status_code' => $payload['status_code'] ?? null,
            'status_message' => $payload['status_message'] ?? null,
            'midtrans_payload' => $payload,
        ]);

        return response()->json(['message' => 'Webhook processed']);
    }
}
