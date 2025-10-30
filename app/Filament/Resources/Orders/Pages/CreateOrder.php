<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrderResource;
use App\Models\Order;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $lastOrder = Order::orderByDesc('id')->first();
        $nextNumber = $lastOrder ? $lastOrder->id + 1 : 1;
        $data['code'] = 'ORDER-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);

        return $data;
    }
}
