<?php

namespace App\Filament\Resources\Provinsis;

use App\Filament\Resources\Provinsis\Pages\CreateProvinsi;
use App\Filament\Resources\Provinsis\Pages\EditProvinsi;
use App\Filament\Resources\Provinsis\Pages\ListProvinsis;
use App\Filament\Resources\Provinsis\Pages\ViewProvinsi;
use App\Filament\Resources\Provinsis\Schemas\ProvinsiForm;
use App\Filament\Resources\Provinsis\Schemas\ProvinsiInfolist;
use App\Filament\Resources\Provinsis\Tables\ProvinsisTable;
use App\Models\Provinsi;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Hidden;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Model;

class ProvinsiResource extends Resource
{
    protected static ?string $model = Provinsi::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Provinsi';

    protected static ?string $navigationLabel = 'Provinsi';

    protected static ?string $pluralModelLabel = 'Provinsi';

    protected static ?string $modelLabel = 'Provinsi';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('nama')
                ->label('Nama Provinsi')
                ->required(),
            Hidden::make('created_by')
                ->default(auth()->id()),
            Hidden::make('updated_by')
                ->default(auth()->id()),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ProvinsiInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->label('Nama Provinsi')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('creator.name')
                    ->label('Dibuat Oleh')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('updater.name')
                    ->label('Diubah Oleh')
                    ->searchable()
                    ->sortable(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProvinsis::route('/'),
            'create' => CreateProvinsi::route('/create'),
            'view' => ViewProvinsi::route('/{record}'),
            'edit' => EditProvinsi::route('/{record}/edit'),
        ];
    }
}
