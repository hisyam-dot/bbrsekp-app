<?php

namespace App\Filament\Resources\Desas\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class DesaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('kecamatan_id')
                    ->relationship('kecamatan', 'id')
                    ->required(),
                TextInput::make('nama')
                    ->required(),
                Textarea::make('profil')
                    ->columnSpanFull(),
                Textarea::make('lokasi')
                    ->columnSpanFull(),
            ]);
    }
}
