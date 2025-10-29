<?php

namespace App\Filament\Resources\Customers\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CustomerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('password')
                    ->password()
                    ->revealable()
                    ->required(),
                TextInput::make('phone')
                    ->tel(),
                FileUpload::make('profile_photo')
                    ->image()
                    ->columnSpanFull(),
                Toggle::make('is_verified')
                    ->required(),
                DatePicker::make('date_of_birth'),
                TextInput::make('gender'),
                Textarea::make('bio')
                    ->columnSpanFull(),
                DateTimePicker::make('banned_until'),
            ]);
    }
}
