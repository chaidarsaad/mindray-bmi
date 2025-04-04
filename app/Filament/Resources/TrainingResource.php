<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrainingResource\Pages;
use App\Filament\Resources\TrainingResource\RelationManagers;
use App\Models\Training;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class TrainingResource extends Resource
{
    protected static ?string $model = Training::class;

    protected static ?string $pluralLabel = 'Pelatihan';
    protected static ?string $navigationLabel = 'Pelatihan';
    protected static ?string $navigationGroup = 'Manajemen Pelatihan';
    protected static ?int $navigationSort = 9;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Pelatihan')
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('judul')
                            ->label('Judul Pelatihan')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\FileUpload::make('image')
                            ->getUploadedFileNameForStorageUsing(
                                fn(TemporaryUploadedFile $file): string => 'pelatihan-' . $file->hashName()
                            )
                            ->helperText('Untuk menjaga performa website disarankan gambar berformat .webp dengan ukuran lebar 1600 pixels, tinggi 1600 pixels.')
                            ->label('Poster Pelatihan')
                            ->image()
                            ->required(),
                        Forms\Components\Toggle::make('is_show')
                            ->label('Tampilkan Pelatihan?')
                            ->default(1),
                    ]),
                // Section::make('Harga Pelatihan')
                //     ->collapsible()
                //     ->schema([
                //         Repeater::make('trainingPrices')
                //             ->label('')
                //             ->relationship()
                //             ->addable(true)
                //             ->deletable(true)
                //             ->schema([
                //                 Forms\Components\Select::make('city_id')
                //                     ->createOptionForm([
                //                         Section::make('Kota')
                //                             ->collapsible()
                //                             ->schema([
                //                                 Forms\Components\TextInput::make('name')
                //                                     ->label('Kota Pelatihan')
                //                                     ->unique(ignoreRecord: true)
                //                                     ->required()
                //                                     ->maxLength(255),
                //                             ]),
                //                     ])
                //                     ->relationship('city', 'name')
                //                     ->label('Kota Pelatihan')
                //                     ->preload()
                //                     ->required()
                //                     ->searchable(),
                //                 Forms\Components\Select::make('training_type_id')
                //                     ->createOptionForm([
                //                         Section::make('Jenis Pelatihan')
                //                             ->collapsible()
                //                             ->schema([
                //                                 Forms\Components\TextInput::make('name')
                //                                     ->label('Jenis Pelatihan USG')
                //                                     ->unique(ignoreRecord: true)
                //                                     ->required()
                //                                     ->maxLength(255),
                //                             ]),
                //                     ])
                //                     ->relationship('trainingType', 'name')
                //                     ->label('Jenis Pelatihan')
                //                     ->preload()
                //                     ->required()
                //                     ->searchable(),
                //                 Forms\Components\TextInput::make('price')
                //                     ->label('Harga Pelatihan')
                //                     ->prefix('Rp')
                //                     ->required()
                //                     ->numeric(),
                //                 Forms\Components\TextInput::make('place')
                //                     ->label('Tempat Pelatihan')
                //                     ->required(),
                //                 Forms\Components\DatePicker::make('start_date')
                //                     ->label('Tanggal Mulai Pelatihan')
                //                     ->required(),
                //                 Forms\Components\DatePicker::make('end_date')
                //                     ->label('Tanggal Berakhir Pelatihan')
                //                     ->required(),
                //             ])
                //     ]),
                Section::make('Deskripsi Pelatihan')
                    ->collapsible()
                    ->schema([
                        TinyEditor::make('description')
                            ->toolbarSticky(1)
                            ->showMenuBar(1)
                            ->label('')
                            ->required()
                            ->columnSpanFull(),
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
                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul Pelatihan')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image')
                    ->label('Poster Pelatihan'),
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
            RelationManagers\TrainingPricesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTrainings::route('/'),
            'create' => Pages\CreateTraining::route('/create'),
            'edit' => Pages\EditTraining::route('/{record}/edit'),
        ];
    }
}
