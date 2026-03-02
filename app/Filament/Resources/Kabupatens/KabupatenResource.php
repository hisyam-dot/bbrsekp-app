<?php

namespace App\Filament\Resources\Kabupatens;

use App\Filament\Resources\Kabupatens\Pages\CreateKabupaten;
use App\Filament\Resources\Kabupatens\Pages\EditKabupaten;
use App\Filament\Resources\Kabupatens\Pages\ListKabupatens;
use App\Filament\Resources\Kabupatens\Pages\ViewKabupaten;
use App\Filament\Resources\Kabupatens\Schemas\KabupatenForm;
use App\Filament\Resources\Kabupatens\Schemas\KabupatenInfolist;
use App\Filament\Resources\Kabupatens\Tables\KabupatensTable;
use App\Models\Kabupaten;
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

class KabupatenResource extends Resource
{
    protected static ?string $model = Kabupaten::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Kabupaten';

    protected static ?string $navigationLabel = 'Kabupaten';

    protected static ?string $pluralModelLabel = 'Kabupaten';

    protected static ?string $modelLabel = 'Kabupaten';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Select::make('provinsi_id')
                ->label('Provinsi')
                ->relationship('provinsi', 'nama')
                ->required(),
            TextInput::make('nama')
                ->label('Nama Kabupaten')
                ->required(),
            Hidden::make('created_by')
                ->default(auth()->id()),
            Hidden::make('updated_by')
                ->default(auth()->id()),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return KabupatenInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->label('Nama Kabupaten')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('provinsi.nama')
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
            'index' => ListKabupatens::route('/'),
            'create' => CreateKabupaten::route('/create'),
            'view' => ViewKabupaten::route('/{record}'),
            'edit' => EditKabupaten::route('/{record}/edit'),
        ];
    }
}
