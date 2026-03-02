<?php

namespace App\Filament\Resources\Kecamatans\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class KecamatanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('kabupaten_id')
                    ->relationship('kabupaten', 'id')
                    ->required(),
                TextInput::make('nama')
                    ->required(),
            ]);
    }
}
