<?php

namespace App\Filament\Resources\Customers\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\CreateRecord;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CustomerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Details')
                    ->columnSpanFull()
                    ->columns()
                    ->schema([
                        FileUpload::make('picture')
                            ->image()
                            ->openable()
                            ->disk('public')
                            ->directory('customers'),
                        TextInput::make('name')
                            ->required(),
                        TextInput::make('email')
                            ->email()
                            ->required(),
                        TextInput::make('phone')
                            ->tel(),
                        DatePicker::make('birthday')
                            ->native(false),
                        Select::make('gender')
                            ->options(['male' => 'Male', 'female' => 'Female', 'other' => 'Other'])
                            ->native(false),
                        TextInput::make('password')
                            ->password()
                            ->confirmed()
                            ->required(fn ($livewire) => $livewire instanceof CreateRecord)
                            ->dehydrateStateUsing(fn ($state) => filled($state) ? bcrypt($state) : null)
                            ->dehydrated(fn ($state) => filled($state)),
                        TextInput::make('password_confirmation')
                            ->password()
                    ]),

                Section::make('Address')
                    ->relationship('address')
                    ->schema([
                        TextInput::make('province'),
                        TextInput::make('city'),
                        TextInput::make('district'),
                        TextInput::make('postcode'),
                        Textarea::make('detail'),
                        Textarea::make('notes'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}
