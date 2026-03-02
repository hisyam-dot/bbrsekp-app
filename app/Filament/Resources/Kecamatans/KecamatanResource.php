<?php

namespace App\Filament\Resources\Kecamatans;

use App\Filament\Resources\Kecamatans\Pages\CreateKecamatan;
use App\Filament\Resources\Kecamatans\Pages\EditKecamatan;
use App\Filament\Resources\Kecamatans\Pages\ListKecamatans;
use App\Filament\Resources\Kecamatans\Pages\ViewKecamatan;
use App\Filament\Resources\Kecamatans\Schemas\KecamatanForm;
use App\Filament\Resources\Kecamatans\Schemas\KecamatanInfolist;
use App\Filament\Resources\Kecamatans\Tables\KecamatansTable;
use App\Models\Kecamatan;
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

class KecamatanResource extends Resource
{
    protected static ?string $model = Kecamatan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Kecamatan';

    protected static ?string $navigationLabel = 'Kecamatan';

    protected static ?string $pluralModelLabel = 'Kecamatan';

    protected static ?string $modelLabel = 'Kecamatan';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Select::make('provinsi_id')
                ->label('Provinsi')
                ->relationship('provinsi', 'nama')
                ->searchable()
                ->reactive()
                ->afterStateUpdated(fn ($set) => [
                    $set('kabupaten_id', null)
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
                ->required(),
            TextInput::make('nama')
                ->label('Nama Kecamatan')
                ->required(),
            Hidden::make('created_by')
                ->default(auth()->id()),
            Hidden::make('updated_by')
                ->default(auth()->id()),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return KecamatanInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->label('Nama Kecamatan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('kabupaten.nama')
                    ->label('Kabupaten')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('kabupaten.provinsi.nama')
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
            'index' => ListKecamatans::route('/'),
            'create' => CreateKecamatan::route('/create'),
            'view' => ViewKecamatan::route('/{record}'),
            'edit' => EditKecamatan::route('/{record}/edit'),
        ];
    }
}
