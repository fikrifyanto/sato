<?php

namespace App\Http\Controllers\Customer;

use App\Enums\OrderPaymentStatus;
use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Pet;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Midtrans\Snap;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $statusFilters = [
            'all' => 'Semua',
            OrderStatus::Pending->value => 'Menunggu Pembayaran',
            OrderStatus::Processing->value => 'Proses',
            OrderStatus::Completed->value => 'Berhasil',
            OrderStatus::Cancelled->value => 'Dibatalkan',
        ];

        $selectedStatus = $request->query('status', 'all');

        if (!array_key_exists($selectedStatus, $statusFilters)) {
            $selectedStatus = 'all';
        }

        $orders = Order::where('customer_id', auth()->id())
            ->when($selectedStatus !== 'all', function ($query) use ($selectedStatus) {
                $query->where('status', $selectedStatus);
            })
            ->latest()
            ->get();

        return view('customer.orders', [
            'orders' => $orders,
            'statusFilters' => $statusFilters,
            'selectedStatus' => $selectedStatus,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @throws Exception
     */
    public function store(Request $request)
    {
        if (!$request->user()) {
            return redirect()->route('login');
        }

        DB::beginTransaction();

        try {
            $cart = Cart::where('customer_id', $request->user()->id)
                ->where('status', 'active')
                ->first();

            $amount = $cart->items->sum(function ($item) {
                return $item->itemable->price * $item->qty;
            });

            /** @var Customer $customer */
            $customer = auth()->guard('customer')->user();
            $address = $customer->address;

            $order = new Order();
            $order->code = 'ORD-' . strtoupper(Str::random(5));
            $order->customer_id = $customer->id;
            $order->customer_name = $customer->name;
            $order->customer_email = $customer->email;
            $order->customer_phone = $customer->phone;
            $order->address_id = $address->id;
            $order->address_type = $address->type;
            $order->address_label = $address->label;
            $order->address_province = $address->province;
            $order->address_city = $address->city;
            $order->address_district = $address->district;
            $order->address_postcode = $address->postcode;
            $order->address_detail = $address->detail;
            $order->address_notes = $address->notes;
            $order->amount = $amount;
            $order->status = OrderStatus::Pending;
            $order->save();

            foreach ($cart->items as $item) {
                $order->orderItems()->create([
                    'item_id' => $item->itemable_id,
                    'item_type' => $item->itemable_type,
                    'is_adoption' => $item->itemable_type == Pet::class,
                    'name' => $item->itemable->name,
                    'description' => $item->itemable->description,
                    'metadata' => $item->itemable->toJson(),
                    'quantity' => $item->qty,
                    'price' => $item->itemable->price,
                    'subtotal' => $item->itemable->price * $item->qty,
                ]);
            }

            $params = [
                'transaction_details' => [
                    'order_id' => $order->code,
                    'gross_amount' => $amount,
                ],

                'customer_details' => [
                    'first_name' => $customer->name,
                    'email' => $customer->email,
                    'phone' => $customer->phone,
                    'billing_address' => [
                        'first_name' => $customer->name,
                        'address' => $address->detail,
                        'city' => $address->city,
                        'postal_code' => $address->postcode,
                        'country_code' => 'IDN',
                    ],
                    'shipping_address' => [
                        'first_name' => $customer->name,
                        'address' => $address->detail,
                        'city' => $address->city,
                        'postal_code' => $address->postcode,
                        'country_code' => 'IDN',
                    ],
                ],

                'item_details' => $cart->items->map(function ($item) {
                    return [
                        'id' => (string)$item->itemable_id,
                        'price' => $item->itemable->price,
                        'quantity' => $item->qty,
                        'name' => $item->itemable->name,
                    ];
                })->toArray(),
            ];

            $snapToken = Snap::getSnapToken($params);

            $order->orderPayments()->create([
                'token' => $snapToken,
                'amount' => $amount,
                'status' => OrderPaymentStatus::Pending,
            ]);

            DB::commit();
        } catch (Exception $e) {
            Log::alert($e->getMessage(), $e->getTrace());
            DB::rollBack();

            return redirect()->back()->with('error', 'Gagal membuat pesanan. Silahkan coba lagi.');
        }

        return redirect()->route('orders.show', $order->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::find($id);

        return view('customer.order_detail', compact('order'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
