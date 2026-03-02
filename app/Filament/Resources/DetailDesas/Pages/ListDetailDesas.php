<?php

namespace App\Filament\Resources\DetailDesas\Pages;

use App\Filament\Resources\DetailDesas\DetailDesaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDetailDesas extends ListRecords
{
    protected static string $resource = DetailDesaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
