<?php

namespace App\Filament\Resources\Kabupatens\Pages;

use App\Filament\Resources\Kabupatens\KabupatenResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListKabupatens extends ListRecords
{
    protected static string $resource = KabupatenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
