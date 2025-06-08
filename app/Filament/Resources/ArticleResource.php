<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use Carbon\Carbon;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $pluralLabel = 'Artikel';
    protected static ?string $navigationLabel = 'Artikel';
    protected static ?string $navigationGroup = 'Manajemen Artikel';
    protected static ?int $navigationSort = 16;

    protected static ?string $label = '';
    public static function getGloballySearchableAttributes(): array
    {
        return ['judul', 'user.name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Judul Artikel' => $record->judul,
            'Penulis Artikel' => $record->user->name,
        ];
    }

    public static function getGlobalSearchResultActions(Model $record): array
    {
        return [
            Action::make('lihat')
                ->url(static::getUrl('edit', ['record' => $record])),
        ];
    }

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
                            ->label('Tampilkan Artikel?')
                            ->live(),
                        Forms\Components\DatePicker::make('published_at')
                            ->label('Tanggal Publikasi')
                            ->default(now())
                            ->hidden(condition: fn(Get $get) => !$get('is_show'))
                            ->required(condition: fn(Get $get) => $get('is_show'))
                            ->displayFormat('l, d F Y')
                            ->native(false)
                            ->closeOnDateSelection()
                            ->live(),
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
                            ->helperText('Untuk menjaga performa website disarankan gambar berformat .webp dengan ukuran lebar 1366 pixels, tinggi 768 pixels, ukuran maksimal 500 kb')
                            ->label('Thumbnail')
                            ->getUploadedFileNameForStorageUsing(
                                fn(TemporaryUploadedFile $file): string => 'artikel-' . $file->hashName()
                            )
                            ->image()
                            ->maxSize(500)
                            ->downloadable()
                            ->openable()
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
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime('l, d F Y')
                    ->label('Tanggal Publikasi')
                    ->sortable(),
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
                Tables\Actions\ViewAction::make('preview')
                    ->label('Preview')
                    ->url(fn($record) => route('admin.articles.preview', $record))
                    ->openUrlInNewTab(),
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
