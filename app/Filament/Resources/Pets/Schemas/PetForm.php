<?php

namespace App\Filament\Resources\Pets\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;

class PetForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columnSpanFull()
                    ->columns()
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->extraInputAttributes([
                                'required' => false,
                            ]),
                        TextInput::make('species'),
                        TextInput::make('age')
                            ->numeric()
                            ->suffix('Years'),
                        Select::make('gender')
                            ->options(['male' => 'Male', 'female' => 'Female', 'unknown' => 'Unknown'])
                            ->native(false),
                        TextInput::make('price')
                            ->mask(RawJs::make('$money($input)'))
                            ->stripCharacters([','])
                            ->prefix('IDR')
                            ->required()
                            ->extraInputAttributes([
                                'required' => false,
                            ]),
                        TextInput::make('breed'),
                        TextInput::make('color'),
                        TextInput::make('weight')
                            ->numeric()
                            ->suffix('Kg'),
                        Toggle::make('vaccinated'),
                        FileUpload::make('images')
                            ->multiple()
                            ->image()
                            ->columnSpanFull()
                            ->openable()
                            ->disk('public')
                            ->directory('pets')
                            ->required(),
                        RichEditor::make('description')
                            ->columnSpanFull(),
                    ])
            ]);
    }
}
