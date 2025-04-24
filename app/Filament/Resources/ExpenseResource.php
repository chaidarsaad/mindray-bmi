<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExpenseResource\Pages;
use App\Filament\Resources\ExpenseResource\RelationManagers;
use App\Models\Expense;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ExpenseResource extends Resource
{
    protected static ?string $model = Expense::class;

    protected static ?string $pluralLabel = 'Pengeluaran';
    protected static ?string $navigationLabel = 'Pengeluaran';
    protected static ?string $navigationGroup = 'Manajemen Pengeluaran';
    protected static ?int $navigationSort = 9;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Pengeluaran')
                    ->collapsible()
                    ->schema([
                        Forms\Components\Textarea::make('name')
                            ->rows(3)
                            ->label('Nama Pengeluaran')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('amount')
                            ->label('Jumlah Pengeluaran')
                            ->required()
                            ->prefix('Rp')
                            ->mask(
                                RawJs::make(<<<'JS'
                                    $input => {
                                        let number = $input.replace(/[^\d]/g, '');
                                        if (number === '') return '0';
                                        return new Intl.NumberFormat('id-ID').format(Number(number));
                                    }
                                JS)
                            )
                            ->stripCharacters([',', '.'])
                            ->numeric(),
                        Forms\Components\DateTimePicker::make('date_expense')
                            ->default(now())
                            ->timezone('Asia/Jakarta')
                            ->locale('id')
                            ->native(false)
                            ->closeOnDateSelection()
                            ->displayFormat('l, d F Y H:i')
                            ->label('Tanggal Pengeluaran')
                            ->required(),
                        Forms\Components\Textarea::make('note')
                            ->label('Catatan')
                            ->rows(3)
                            ->helperText('Opsional')
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('payment_proofs')
                            ->label('Bukti Pengeluaran')
                            ->getUploadedFileNameForStorageUsing(
                                fn(TemporaryUploadedFile $file): string => 'bukti-pengeluaran-' . $file->hashName()
                            )
                            ->image()
                            ->multiple()
                            ->openable()
                            ->downloadable()
                            ->helperText('Bisa lebih dari 1 Bukti Pembayaran & Tidak wajib diisi'),
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
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Pengeluaran')
                    ->searchable(),
                Tables\Columns\TextColumn::make('amount')
                    ->label('Jumlah Pengeluaran')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_expense')
                    ->label('Tanggal Pengeluaran')
                    ->formatStateUsing(fn($state) => \Carbon\Carbon::parse($state)
                        ->locale('id')
                        ->timezone('Asia/Jakarta')
                        ->translatedFormat('l, d F Y H:i'))
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
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->modalHeading(fn($record) => 'Hapus Pengeluaran: ' . $record->name),
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
            'index' => Pages\ListExpenses::route('/'),
            'create' => Pages\CreateExpense::route('/create'),
            'edit' => Pages\EditExpense::route('/{record}/edit'),
        ];
    }
}
