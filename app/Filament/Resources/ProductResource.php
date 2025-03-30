<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $pluralLabel = 'Produk USG';
    protected static ?string $navigationLabel = 'Produk USG';
    protected static ?string $navigationGroup = 'Data Utama';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Produk')
                    ->collapsible()
                    ->schema([
                        Forms\Components\Select::make('category_id')
                            ->relationship('category', 'name')
                            ->label('Kategori')
                            ->preload()
                            ->searchable()
                            ->required()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nama Kategori')
                                    ->unique(ignoreRecord: true)
                                    ->required()
                                    ->maxLength(255),
                            ]),
                        Forms\Components\TextInput::make('name')
                            ->label('Nama')
                            ->unique(ignoreRecord: true)
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('subname')
                            ->label('Sub Nama')
                            ->unique(ignoreRecord: true)
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Toggle::make('is_show')
                            ->default(1)
                            ->label('Tampilkan produk?')
                            ->required(),
                        Forms\Components\FileUpload::make('images')
                            ->helperText('Untuk menjaga performa website disarankan gambar berformat .webp dengan ukuran lebar 720 pixels, tinggi 1005 pixels.')
                            ->getUploadedFileNameForStorageUsing(
                                fn(TemporaryUploadedFile $file): string => 'produk-usg-' . $file->hashName()
                            )
                            ->label('Foto Produk, Disarankan lebih dari 1 foto')
                            ->multiple()
                            ->reorderable()
                            ->required()
                            ->image(),

                    ]),
                Section::make('Deskripsi Produk')
                    ->collapsible()
                    ->schema([
                        Repeater::make('descriptions')
                            ->label('')
                            ->addable(true)
                            ->deletable(true)
                            ->relationship()
                            ->schema([
                                Forms\Components\TextInput::make('judul_deskripsi')
                                    ->label('Nama Deskripsi')
                                    ->required()
                                    ->maxLength(255),
                                TinyEditor::make('description')
                                    ->showMenuBar(1)
                                    ->toolbarSticky(1)
                                    ->required()
                                    ->label('Deskripsi')
                                    ->columnSpanFull(),
                            ])
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->paginationPageOptions([5, 25, 50, 100, 250])
            ->defaultPaginationPageOption(5)
            ->defaultSort('id', direction: 'desc')
            ->columns([
                Tables\Columns\ImageColumn::make('images')
                    ->label('Foto')
                    ->stacked()
                    ->circular(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subname')
                    ->label('Subnama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('Kategori')
                    ->relationship('category', 'name')
                    ->preload()
                    ->searchable()
                    ->multiple(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // RelationManagers\DescriptionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    // public static function getItemsRepeater(): Repeater
    // {
    //     return;
    // }
}
