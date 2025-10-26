<?php

namespace App\Filament\Resources\Animals\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;

class AnimalForm
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
                            ->required(),
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
                            ->required(),
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
                            ->directory('animals')
                            ->required(),
                        RichEditor::make('description')
                            ->columnSpanFull(),
                    ])
            ]);
    }
}
