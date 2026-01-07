<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;

class ProductForm
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
                        TextInput::make('price')
                            ->required()
                            ->mask(RawJs::make('$money($input)'))
                            ->stripCharacters([','])
                            ->prefix('IDR'),
                        TextInput::make('stock')
                            ->required()
                            ->numeric(),
                        TextInput::make('category'),
                        FileUpload::make('images')
                            ->image()
                            ->columnSpanFull()
                            ->openable()
                            ->disk('public')
                            ->directory('products')
                            ->required(),
                        RichEditor::make('description')
                            ->columnSpanFull(),
                    ])
            ]);
    }
}
