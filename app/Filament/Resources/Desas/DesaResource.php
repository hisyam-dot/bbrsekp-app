<?php

namespace App\Filament\Resources\Desas;

use App\Filament\Resources\Desas\Pages\CreateDesa;
use App\Filament\Resources\Desas\Pages\EditDesa;
use App\Filament\Resources\Desas\Pages\ListDesas;
use App\Filament\Resources\Desas\Pages\ViewDesa;
use App\Filament\Resources\Desas\Schemas\DesaForm;
use App\Filament\Resources\Desas\Schemas\DesaInfolist;
use App\Filament\Resources\Desas\Tables\DesasTable;
use App\Models\Desa;
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

class DesaResource extends Resource
{
    protected static ?string $model = Desa::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Desa';

    protected static ?string $navigationLabel = 'Desa';

    protected static ?string $pluralModelLabel = 'Desa';

    protected static ?string $modelLabel = 'Desa';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Select::make('provinsi_id')
                ->label('Provinsi')
                ->relationship('provinsi', 'nama')
                ->searchable()
                ->reactive()
                ->afterStateUpdated(fn ($set) => [
                    $set('kabupaten_id', null),
                    $set('kecamatan_id', null)
                ])
                ->required(),
            Select::make('kabupaten_id')
                ->label('Kabupaten')
                ->relationship(name: 'kabupaten', 
                    titleAttribute: 'nama',
                    modifyQueryUsing: fn ($query, $get) => $query->where('provinsi_id', $get('provinsi_id')))
                ->searchable()
                ->reactive()
                ->disabled(fn ($get) => !$get('provinsi_id'))
                ->afterStateUpdated(fn ($set) => [
                    $set('kecamatan_id', null)
                ])
                ->required(),
            Select::make('kecamatan_id')
                ->label('Kecamatan')
                ->relationship(name: 'kecamatan',
                    titleAttribute: 'nama',
                    modifyQueryUsing: fn ($query, $get) => $query->where('kabupaten_id', $get('kabupaten_id')))
                ->searchable()
                ->reactive()
                ->disabled(fn ($get) => !$get('kabupaten_id'))
                ->required(),
            TextInput::make('nama')
                ->label('Nama Desa')
                ->required(),
            Hidden::make('created_by')
                ->default(auth()->id()),
            Hidden::make('updated_by')
                ->default(auth()->id()),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DesaInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->label('Nama Desa')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('kecamatan.nama')
                    ->label('Kecamatan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('kecamatan.kabupaten.nama')
                    ->label('Kabupaten')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('kecamatan.kabupaten.provinsi.nama')
                    ->label('Provinsi')
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
            ])

            ->modifyQueryUsing(fn ($query) => $query->with(['kecamatan', 'kabupaten', 'provinsi']));
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
            'index' => ListDesas::route('/'),
            'create' => CreateDesa::route('/create'),
            'view' => ViewDesa::route('/{record}'),
            'edit' => EditDesa::route('/{record}/edit'),
        ];
    }
}
