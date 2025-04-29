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
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class TrainingResource extends Resource
{
    protected static ?string $model = Training::class;

    protected static ?string $pluralLabel = 'Pelatihan';
    protected static ?string $navigationLabel = 'Pelatihan';
    protected static ?string $navigationGroup = 'Manajemen Pelatihan';
    protected static ?int $navigationSort = 14;

    protected static ?string $label = '';
    public static function getGloballySearchableAttributes(): array
    {
        return ['judul'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Judul Pelatihan' => $record->judul,
        ];
    }

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
                            ->helperText('Untuk menjaga performa website disarankan gambar berformat .webp dengan ukuran lebar 1600 pixels, tinggi 1600 pixels, ukuran maksimal 1 mb.')
                            ->label('Poster Pelatihan')
                            ->image()
                            ->maxSize(500)
                            ->downloadable()
                            ->openable()->required(),
                        Forms\Components\Toggle::make('is_show')
                            ->label('Tampilkan Pelatihan?')
                            ->default(1),
                    ]),
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
                Tables\Actions\Action::make('lihat_detail')
                    ->label('Lihat Peserta')
                    ->icon('heroicon-o-eye')
                    ->color('success')
                    ->modalHeading(fn($record) => 'Pelatihan: ' . $record->judul)
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Tutup')
                    ->action(fn() => null)
                    ->modalContent(function ($record) {
                        $record->load([
                            'trainingPrices.city',
                            'trainingPrices.trainingType',
                            'trainingPrices.orderDetails' => fn($query) =>
                            $query->whereHas('trainingOrder', function ($q) {
                                $q->where('payment_status', 'paid');
                            })->with('trainingOrder.user'),
                        ]);

                        return view('filament.resources.training-resource.modals.training-detail', [
                            'training' => $record,
                        ]);
                    }),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->modalHeading(fn($record) => 'Hapus Pelatihan: ' . $record->judul),
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
            'view' => Pages\ViewTraining::route('/{record}/view'),
        ];
    }
}
