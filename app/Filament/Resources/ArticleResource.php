<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $pluralLabel = 'Artikel';
    protected static ?string $navigationLabel = 'Artikel';
    protected static ?string $navigationGroup = 'Data Utama';
    protected static ?int $navigationSort = 3;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Artikel')
                    ->collapsible()
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->label('Penulis')
                            ->helperText('Jika dikosongkan, maka penulis akan tampil sebagai admin')
                            ->searchable()
                            ->default(auth()->user()->id)
                            ->preload(),
                        Forms\Components\Toggle::make('is_show')
                            ->default(1)
                            ->label('Tampilkan Artikel?'),
                        Forms\Components\TextInput::make('judul')
                            ->label('Judul')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('sub_judul')
                            ->label('Sub Judul')
                            ->helperText('Boleh kosong')
                            ->maxLength(255),
                        Forms\Components\Select::make('tags')
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->label('Tag')
                                    ->unique(ignoreRecord: true)
                                    ->required()
                                    ->maxLength(255),
                            ])
                            ->label('Tags')
                            ->multiple()
                            ->relationship('tags', 'name')
                            ->preload()
                            ->searchable(),
                        Forms\Components\FileUpload::make('image')
                            ->helperText('Untuk menjaga performa website disarankan gambar berformat .webp dengan ukuran lebar 1366 pixels, tinggi 768 pixels.')
                            ->label('Thumbnail')
                            ->getUploadedFileNameForStorageUsing(
                                fn(TemporaryUploadedFile $file): string => 'artikel-' . $file->hashName()
                            )
                            ->image()
                            ->required(),
                    ]),
                Section::make('Isi Artikel')
                    ->collapsible()
                    ->schema([
                        TinyEditor::make('content')
                            ->showMenuBar(1)
                            ->toolbarSticky(1)
                            ->required()
                            ->label('')
                            ->columnSpanFull(),
                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->paginationPageOptions([5, 25, 50, 100, 250])
            ->defaultPaginationPageOption(5)
            ->defaultSort('id', direction: 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('judul')
                    ->limit(30)
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image')
                    ->label('Thumbnail'),
                Tables\Columns\TextColumn::make('views')
                    ->label('Jumlah dilihat')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('is_show')
                    ->label('Tampilkan Artikel?'),
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
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->modalHeading(fn($record) => 'Hapus Artikel: ' . $record->judul),

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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
