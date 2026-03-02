<?php

namespace App\Filament\Resources\DetailDesas\Pages;

use App\Filament\Resources\DetailDesas\DetailDesaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDetailDesa extends EditRecord
{
    protected static string $resource = DetailDesaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
