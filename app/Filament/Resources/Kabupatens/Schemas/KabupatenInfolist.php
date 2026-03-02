<?php

namespace App\Filament\Resources\Kabupatens\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class KabupatenInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('provinsi.id')
                    ->label('Provinsi'),
                TextEntry::make('nama'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
