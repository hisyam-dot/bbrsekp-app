<?php

namespace App\Filament\Widgets;

use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\DetailDesa;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverView extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Provinsi', Provinsi::count())
                ->icon('heroicon-o-map')
                ->description('Wilayah Provinsi'),
            Stat::make('Total Kabupaten', Kabupaten::count())
                ->icon('heroicon-o-building-office')
                ->description('Wilayah Kabupaten'),
            Stat::make('Total Kecamatan', Kecamatan::count())
                ->icon('heroicon-o-map-pin')
                ->description('Wilayah Kecamatan'),
            Stat::make('Total Desa', Desa::count())
                ->icon('heroicon-o-home')
                ->description('Wilayah Desa'),
            Stat::make('Total Dokumen dan Informasi', DetailDesa::count())
                ->icon('heroicon-o-document-text')
                ->description('Dokumen & Informasi'),
            Stat::make('Total Manajemen User', User::count())
                ->icon('heroicon-o-users')
                ->description('Manajemen User'),
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
