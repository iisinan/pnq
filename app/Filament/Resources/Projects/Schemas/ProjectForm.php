<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('category'),
                TextInput::make('client_name'),
                TextInput::make('year')
                    ->numeric(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('content')
                    ->columnSpanFull(),
                TextInput::make('thumbnail'),
                Textarea::make('gallery')
                    ->columnSpanFull(),
                Toggle::make('is_featured')
                    ->required(),
            ]);
    }
}
