<?php

namespace App\Filament\Resources\Desas\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class DesaInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('kecamatan.id')
                    ->label('Kecamatan'),
                TextEntry::make('nama'),
                TextEntry::make('profil')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('lokasi')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
