<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrainingTypeResource\Pages;
use App\Filament\Resources\TrainingTypeResource\RelationManagers;
use App\Models\TrainingType;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TrainingTypeResource extends Resource
{
    protected static ?string $model = TrainingType::class;

    protected static ?string $pluralLabel = 'Jenis Pelatihan USG';
    protected static ?string $navigationLabel = 'Jenis Pelatihan USG';
    protected static ?string $navigationGroup = 'Manajemen Pelatihan';
    protected static ?int $navigationSort = 11;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Jenis Pelatihan')
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Jenis Pelatihan USG')
                            ->unique(ignoreRecord: true)
                            ->required()
                            ->maxLength(255),
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
                    ->label('Jenis Pelatihan USG')
                    ->sortable()
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
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalHeading('Ubah Jenis Pelatihan'),
                Tables\Actions\DeleteAction::make()
                    ->modalHeading(fn($record) => 'Hapus Jenis Pelatihan: ' . $record->name),
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
            'index' => Pages\ListTrainingTypes::route('/'),
            // 'create' => Pages\CreateTrainingType::route('/create'),
            // 'edit' => Pages\EditTrainingType::route('/{record}/edit'),
        ];
    }
}
