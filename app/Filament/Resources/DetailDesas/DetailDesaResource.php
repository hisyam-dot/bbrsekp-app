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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Filament\Actions\Action;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DokumenInformasiExcel;

class DetailDesaResource extends Resource
{
    protected static ?string $model = DetailDesa::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Dokumen dan Informasi';

    protected static ?string $navigationLabel = 'Dokumen dan Informasi';

    protected static ?string $pluralModelLabel = 'Dokumen dan Informasi';

    protected static ?string $modelLabel = 'Dokumen dan Informasi';

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
                ->nullable(),
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
                ->nullable(),
            Select::make('desa_id')
                ->label('Desa')
                ->relationship(name: 'desa',
                    titleAttribute: 'nama',
                    modifyQueryUsing: fn ($query, $get) => $query->where('kecamatan_id', $get('kecamatan_id')))
                ->searchable()
                ->reactive()
                ->disabled(fn ($get) => !$get('kecamatan_id'))
                ->nullable(),
            TextArea::make('profil')
                ->label('Profil')
                ->rows(6),
            TextInput::make('judul')
                ->label('Judul'),
            TextInput::make('lokasi')
                ->label('Lokasi')
                ->url(),
            FileUpload::make('foto')
                ->label('Foto')
                ->multiple()
                ->maxFiles(4)
                ->maxSize(5120)
                ->image()
                ->disk('public')
                ->directory('fotos')
                ->helperText('Format: jpg, jpeg, png. Maksimal ukuran per file: 5MB. Maksimal jumlah file: 4.'),
            FileUpload::make('bahan_paparan')
                ->label('Bahan Paparan')
                ->multiple()
                ->maxFiles(4)
                ->maxSize(10240)
                ->disk('public')
                ->directory('bahan_paparans')
                ->getUploadedFileNameForStorageUsing(function ($file) {
                    $namaAsli = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $ext = $file->getClientOriginalExtension();
                    $namaFormatted = Str::title(str_replace(['-', '_'], ' ', $namaAsli));

                    return Str::slug($namaAsli) . '-' . time() . '.' . $ext;
                })
                ->acceptedFileTypes([
                    'application/pdf',
                    'application/msword',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    'application/vnd.ms-excel',
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    'application/vnd.ms-powerpoint',
                    'application/vnd.openxmlformats-officedocument.presentationml.presentation'
                ])
                ->helperText('Format: pdf, doc, docx, xls, xlsx, ppt, pptx. Maksimal ukuran per file: 10MB. Maksimal jumlah file: 4.'),
            FileUpload::make('laporan')
                ->label('Laporan')
                ->multiple()
                ->maxFiles(4)
                ->maxSize(10240)
                ->disk('public')
                ->directory('laporans')
                ->getUploadedFileNameForStorageUsing(function ($file) {
                    $namaAsli = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $ext = $file->getClientOriginalExtension();
                    $namaFormatted = Str::title(str_replace(['-', '_'], ' ', $namaAsli));

                    return Str::slug($namaAsli) . '-' . time() . '.' . $ext;
                })
                ->acceptedFileTypes([
                    'application/pdf',
                    'application/msword',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    'application/vnd.ms-excel',
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    'application/vnd.ms-powerpoint',
                    'application/vnd.openxmlformats-officedocument.presentationml.presentation'
                ])
                ->helperText('Format: pdf, doc, docx, xls, xlsx, ppt, pptx. Maksimal ukuran per file: 10MB.Maksimal jumlah file: 4.'),
            FileUpload::make('dokumen')
                ->label('Dokumen Lainnya')
                ->multiple()
                ->maxFiles(8)
                ->maxSize(10240)
                ->disk('public')
                ->directory('dokumens')
                ->getUploadedFileNameForStorageUsing(function ($file) {
                    $namaAsli = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $ext = $file->getClientOriginalExtension();
                    $namaFormatted = Str::title(str_replace(['-', '_'], ' ', $namaAsli));

                    return Str::slug($namaAsli) . '-' . time() . '.' . $ext;
                })
                ->acceptedFileTypes([
                    'application/pdf',
                    'application/msword',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    'application/vnd.ms-excel',
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    'application/vnd.ms-powerpoint',
                    'application/vnd.openxmlformats-officedocument.presentationml.presentation'
                ])
                ->helperText('Format: pdf, doc, docx, xls, xlsx, ppt, pptx. Maksimal ukuran per file: 10MB. Maksimal jumlah file: 8.'),
            Hidden::make('created_by')
                ->default(auth()->id())
                ->dehydrated(fn ($operation) => $operation === 'create'),
            Hidden::make('updated_by')
                ->dehydrated(false),
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
                TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('lokasi')
                    ->label('Lokasi')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('creator.name')
                    ->label('Dibuat Oleh') 
                    ->searchable()
                    ->sortable(),
                TextColumn::make('updater.name')
                    ->label('Diubah Oleh')
                    ->placeholder('-')
                    ->searchable()
                    ->sortable(),
            ])
            ->HeaderActions([
                Action::make('export')
                    ->label('Download Excel')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(function () {
                        return Excel::download(new DokumenInformasiExcel, 'dokumen_informasi.xlsx');
                    }),
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
