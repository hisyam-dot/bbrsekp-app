<?php

namespace App\Filament\Resources\SearchLogs;

use App\Filament\Resources\SearchLogs\Pages\CreateSearchLog;
use App\Filament\Resources\SearchLogs\Pages\EditSearchLog;
use App\Filament\Resources\SearchLogs\Pages\ListSearchLogs;
use App\Filament\Resources\SearchLogs\Schemas\SearchLogForm;
use App\Filament\Resources\SearchLogs\Tables\SearchLogsTable;
use App\Models\SearchLog;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SearchLogResource extends Resource
{
    protected static ?string $model = SearchLog::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Kata Populer';

    protected static ?string $navigationLabel = 'Kata Populer';

    protected static ?string $pluralModelLabel = 'Kata Populer';

    protected static ?string $modelLabel = 'Kata Populer';

    protected static ?int $navigationSort = 7;

    public static function form(Schema $schema): Schema
    {
        return SearchLogForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('keyword')
                    ->label('Kata Populer')
                    ->searchable(),
                TextColumn::make('total')
                    ->label('Total Pencarian')
                    ->sortable(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSearchLogs::route('/'),
            'create' => CreateSearchLog::route('/create'),
            'edit' => EditSearchLog::route('/{record}/edit'),
        ];
    }
}
