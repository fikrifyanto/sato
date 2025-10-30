<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Enums\OrderStatus;
use App\Models\Pet;
use App\Models\Customer;
use App\Models\Product;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Customer')
                    ->columnSpanFull()
                    ->columns()
                    ->schema([
                        Select::make('customer_id')
                            ->relationship('customer', 'name')
                            ->required()
                            ->native(false)
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                $customer = Customer::find($state);
                                $set('customer_name', $customer->name);
                                $set('customer_email', $customer->email);
                                $set('customer_phone', $customer->phone);
                                $set('address_id', $customer->address?->id);
                                if($customer->address) {
                                    $set('address_type', $customer->address->type);
                                    $set('address_label', $customer->address->label);
                                    $set('address_type', $customer->address->type);
                                    $set('address_province', $customer->address->province);
                                    $set('address_city', $customer->address->city);
                                    $set('address_district', $customer->address->district);
                                    $set('address_postcode', $customer->address->postcode);
                                    $set('address_detail', $customer->address->detail);
                                    $set('address_notes', $customer->address->notes);
                                }
                            }),
                        Hidden::make('address_id'),
                        Hidden::make('address_type'),
                        Hidden::make('address_label'),
                        TextInput::make('customer_name')
                            ->label('Name')
                            ->readOnly()
                            ->required(),
                        TextInput::make('customer_email')
                            ->label('Email')
                            ->readOnly()
                            ->email()
                            ->required(),
                        TextInput::make('customer_phone')
                            ->label('Phone')
                            ->readOnly()
                            ->tel(),
                        TextInput::make('address_province')
                            ->label('Province')
                            ->readOnly()
                            ->required(),
                        TextInput::make('address_city')
                            ->label('City')
                            ->readOnly()
                            ->required(),
                        TextInput::make('address_district')
                            ->label('District')
                            ->readOnly()
                            ->required(),
                        TextInput::make('address_postcode')
                            ->label('Postcode')
                            ->readOnly()
                            ->required(),
                        Textarea::make('address_detail')
                            ->label('Detail')
                            ->readOnly()
                            ->required(),
                        Textarea::make('address_notes')
                            ->readOnly()
                            ->label('Notes'),
                    ]),
                Section::make('Details')
                    ->columnSpanFull()
                    ->columns()
                    ->schema([
                        TextInput::make('amount')
                            ->label('Total Amount')
                            ->prefix('IDR')
                            ->readOnly()
                            ->required(),

                        Select::make('status')
                            ->options(OrderStatus::class)
                            ->required()
                            ->default('pending')
                            ->disabled()
                            ->dehydrated()
                            ->native(false),

                        Repeater::make('orderItems')
                            ->relationship()
                            ->columnSpanFull()
                            ->label('Order Items')
                            ->schema([
                                Toggle::make('is_adoption')
                                    ->label('Is Adoption?')
                                    ->default(false)
                                    ->reactive()
                                    ->afterStateUpdated(function (callable $set, callable $get) {
                                        $set('item_id', null);
                                        $set('price', null);
                                        $set('quantity', 1);

                                        $total = collect($get('../../orderItems'))
                                            ->map(fn($item) => ($item['quantity'] ?? 0) * ($item['price'] ?? 0))
                                            ->sum();
                                        $set('../../amount', $total);
                                    }),

                                Select::make('item_id')
                                    ->label('Item')
                                    ->options(function (callable $get) {
                                        if ($get('is_adoption')) {
                                            return Pet::all()->pluck('name', 'id');
                                        }

                                        return Product::all()->pluck('name', 'id');
                                    })
                                    ->reactive()
                                    ->required()
                                    ->searchable()
                                    ->native(false)
                                    ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                        if (!$state) {
                                            $set('price', null);
                                            $set('subtotal', 0);
                                            return;
                                        }

                                        if ($get('is_adoption')) {
                                            $animal = Pet::find($state);
                                            $set('price', $animal?->price ?? 0);
                                            $set('item_type', Pet::class);
                                            $set('name', $animal?->name ?? '');
                                            $set('description', $animal?->description ?? '');
                                            $set('metadata', $animal?->toJson());
                                        } else {
                                            $product = Product::find($state);
                                            $set('price', $product?->price ?? 0);
                                            $set('item_type', Product::class);
                                            $set('name', $product?->name ?? '');
                                            $set('description', $product?->description ?? '');
                                            $set('metadata', $product?->toJson());
                                        }

                                        $qty = $get('quantity') ?? 1;
                                        $set('subtotal', $qty * ($get('price') ?? 0));

                                        $total = collect($get('../../orderItems'))
                                            ->map(fn($item) => ($item['quantity'] ?? 0) * ($item['price'] ?? 0))
                                            ->sum();
                                        $set('../../amount', $total);
                                    }),

                                Hidden::make('item_type'),
                                Hidden::make('name'),
                                Hidden::make('description'),
                                Hidden::make('metadata'),

                                TextInput::make('quantity')
                                    ->numeric()
                                    ->minValue(1)
                                    ->default(1)
                                    ->reactive()
                                    ->required()
                                    ->afterStateUpdated(function (callable $get, callable $set) {
                                        $set('subtotal', ($get('quantity') ?? 0) * ($get('price') ?? 0));
                                    }),

                                TextInput::make('price')
                                    ->prefix('IDR')
                                    ->required()
                                    ->reactive()
                                    ->readOnly()
                                    ->afterStateUpdated(function (callable $get, callable $set) {
                                        $set('subtotal', ($get('quantity') ?? 0) * ($get('price') ?? 0));
                                    }),

                                TextInput::make('subtotal')
                                    ->label('Subtotal')
                                    ->prefix('IDR')
                                    ->readOnly()
                                    ->reactive()
                                    ->default(0),
                            ])
                            ->columns(5)
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                $total = collect($state)
                                    ->map(fn($item) => ($item['quantity'] ?? 0) * ($item['price'] ?? 0))
                                    ->sum();

                                $set('amount', $total);
                            }),
                    ])
            ]);
    }
}
