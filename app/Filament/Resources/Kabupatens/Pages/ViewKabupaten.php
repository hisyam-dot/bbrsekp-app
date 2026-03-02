<?php

namespace App\Filament\Resources\Kabupatens\Pages;

use App\Filament\Resources\Kabupatens\KabupatenResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewKabupaten extends ViewRecord
{
    protected static string $resource = KabupatenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
