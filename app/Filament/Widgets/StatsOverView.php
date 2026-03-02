<?php

namespace App\Filament\Widgets;

use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\DetailDesa;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverView extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Provinsi', Provinsi::count())
                ->icon('heroicon-o-map')
                ->color('primary'),
            Stat::make('Total Kabupaten', Kabupaten::count())
                ->icon('heroicon-o-building-office')
                ->color('success'),
            Stat::make('Total Kecamatan', Kecamatan::count())
                ->icon('heroicon-o-map-pin')
                ->color('warning'),
            Stat::make('Total Desa', Desa::count())
                ->icon('heroicon-o-home')
                ->color('info'),
            Stat::make('Total Detail Desa', DetailDesa::count())
                ->icon('heroicon-o-document-text')
                ->color('danger'),
        ];
    }

    protected function getColumns(): int | array
    {
        return [
            'md' => 2,
            'xl' => 3,
        ];
    }
}
