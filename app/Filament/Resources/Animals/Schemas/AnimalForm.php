<?php

namespace App\Filament\Resources\Animals\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AnimalForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('species')
                    ->required(),
                TextInput::make('age')
                    ->numeric(),
                TextInput::make('gender'),
                Textarea::make('description')
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->image(),
                TextInput::make('status')
                    ->required()
                    ->default('available'),
                TextInput::make('price')
                    ->numeric()
                    ->prefix('$'),
                TextInput::make('breed'),
                Toggle::make('vaccinated')
                    ->required(),
                TextInput::make('color'),
                TextInput::make('weight')
                    ->numeric(),
            ]);
    }
}
