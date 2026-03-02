<?php

namespace App\Filament\Resources\DetailDesas;

use App\Filament\Resources\DetailDesas\Pages\CreateDetailDesa;
use App\Filament\Resources\DetailDesas\Pages\EditDetailDesa;
use App\Filament\Resources\DetailDesas\Pages\ListDetailDesas;
use App\Filament\Resources\DetailDesas\Schemas\DetailDesaForm;
use App\Filament\Resources\DetailDesas\Tables\DetailDesasTable;
use App\Models\DetailDesa;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Components\FileUpload;
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

class DetailDesaResource extends Resource
{
    protected static ?string $model = DetailDesa::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Detail Desa';

    protected static ?string $navigationLabel = 'Dokumen dan Informasi';

    protected static ?string $pluralModelLabel = 'Detail Desa';

    protected static ?string $modelLabel = 'Detail Desa';

    protected static ?int $navigationSort = 5;

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
                    $set('kecamatan_id', null),
                    $set('desa_id', null)
                ])
                ->required(),
            Select::make('kabupaten_id')
                ->label('Kabupaten')
                ->relationship(name: 'kabupaten',
                    titleAttribute: 'nama',
                    modifyQueryUsing: fn ($query, $get) => $query->where('provinsi_id', $get ('provinsi_id')))
                ->searchable()
                ->reactive()
                ->disabled(fn ($get) => !$get ('provinsi_id'))
                ->afterStateUpdated(fn ($set) => [
                    $set('kecamatan_id', null),
                    $set('desa_id', null)
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
                ->afterStateUpdated(fn ($set) => [
                    $set('desa_id', null)
                ])
                ->required(),
            Select::make('desa_id')
                ->label('Desa')
                ->relationship(name: 'desa',
                    titleAttribute: 'nama',
                    modifyQueryUsing: fn ($query, $get) => $query->where('kecamatan_id', $get('kecamatan_id')))
                ->searchable()
                ->reactive()
                ->disabled(fn ($get) => !$get('kecamatan_id'))
                ->required(),
            TextInput::make('lokasi')
                ->label('Lokasi Desa')
                ->url()
                ->required(),
            TextArea::make('profil_desa')
                ->label('Profil Desa')
                ->rows(6)
                ->required(),
            FileUpload::make('foto')
                ->label('Foto Desa')
                ->multiple()
                ->image()
                ->disk('public')
                ->directory('fotos'),
            FileUpload::make('bahan_paparan')
                ->label('Bahan Paparan')
                ->multiple()
                ->disk('public')
                ->directory('bahan_paparans')
                ->acceptedFileTypes([
                    'application/pdf',
                    'application/msword',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    'application/vnd.ms-excel',
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    'application/vnd.ms-powerpoint',
                    'application/vnd.openxmlformats-officedocument.presentationml.presentation'
                ]),
            FileUpload::make('laporan')
                    ->label('Laporan')
                    ->multiple()
                    ->disk('public')
                    ->directory('laporans')
                    ->acceptedFileTypes([
                        'application/pdf',
                        'application/msword',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        'application/vnd.ms-excel',
                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        'application/vnd.ms-powerpoint',
                        'application/vnd.openxmlformats-officedocument.presentationml.presentation'
                    ]),
            FileUpload::make('dokumen')
                ->label('Dokumen Lainnya')
                ->multiple()
                ->disk('public')
                ->directory('dokumens')
                ->acceptedFileTypes([
                    'application/pdf',
                    'application/msword',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    'application/vnd.ms-excel',
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    'application/vnd.ms-powerpoint',
                    'application/vnd.openxmlformats-officedocument.presentationml.presentation'
                ]),
            Hidden::make('created_by')
                ->default(auth()->id()),
            Hidden::make('updated_by')
                ->default(auth()->id()),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DetailDesaInfoList::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('provinsi.nama')
                    ->label('Provinsi')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('desa.nama')
                    ->label('Desa')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('lokasi')
                    ->label('Lokasi')
                    ->url(fn ($record) => $record->lokasi)
                    ->openUrlInNewTab(),
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
            'index' => ListDetailDesas::route('/'),
            'create' => CreateDetailDesa::route('/create'),
            'edit' => EditDetailDesa::route('/{record}/edit'),
        ];
    }
}
