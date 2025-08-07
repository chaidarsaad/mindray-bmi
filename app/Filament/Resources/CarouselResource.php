<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarouselResource\Pages;
use App\Filament\Resources\CarouselResource\RelationManagers;
use App\Models\Carousel;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Spatie\ImageOptimizer\OptimizerChainFactory;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;


class CarouselResource extends Resource
{
    protected static ?string $model = Carousel::class;

    protected static ?string $pluralLabel = 'Banner';
    protected static ?string $navigationLabel = 'Banner';
    protected static ?string $navigationGroup = 'Data Utama';
    protected static ?int $navigationSort = 2;
    protected static ?string $slug = 'banner';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Banner')
                    ->collapsible()
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->getUploadedFileNameForStorageUsing(
                                fn(TemporaryUploadedFile $file): string => 'banner-' . $file->hashName()
                            )
                            ->directory('carousels')
                            ->label('Gambar')
                            ->image()
                            ->maxSize(500)
                            ->downloadable()
                            ->openable()
                            ->required()
                            ->helperText('Untuk menjaga performa website disarankan gambar berformat .webp dengan ukuran lebar 2000 pixels, tinggi 1125 pixels.'),
                        Forms\Components\TextInput::make('url')
                            ->placeholder('diawali dengan https://')
                            ->helperText('Jika tidak diisi banner tidak bisa di klik, jika di isi maka banner bisa diklik dan akan mengarah ke link tersebut')
                            ->label('Link (Opsional)')
                            ->url()
                            ->maxLength(255)
                            ->default(null),
                        Forms\Components\Toggle::make('is_show')
                            ->label('Tampilkan Banner?')
                            ->default(1)
                            ->required()
                            ->live(),
                        Forms\Components\Toggle::make('is_priority')
                            ->label('Prioritaskan Banner?')
                            ->helperText('Jika diprioritaskan, banner akan tampil paling awal.')
                            ->default(0)
                            ->required()
                            ->visible(fn($get) => $get('is_show')),
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
                Tables\Columns\ImageColumn::make('image')
                    ->label('Gambar'),
                Tables\Columns\ToggleColumn::make('is_show')
                    ->label('Tampilkan Banner?'),
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
                    ->modalHeading('Hapus Banner'),
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
            'index' => Pages\ListCarousels::route('/'),
            'create' => Pages\CreateCarousel::route('/create'),
            'edit' => Pages\EditCarousel::route('/{record}/edit'),
        ];
    }
}
