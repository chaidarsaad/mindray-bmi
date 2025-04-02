<?php

namespace App\Filament\Resources\TrainingResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TrainingPricesRelationManager extends RelationManager
{
    protected static string $relationship = 'trainingPrices';
    protected static ?string $pluralLabel = 'Harga Pelatihan';
    protected static ?string $label = 'Harga Pelatihan';
    protected static ?string $pluralModelLabel = 'Harga Pelatihan';
    protected static ?string $modelLabel = 'Harga Pelatihan';
    protected static ?string $title = 'Harga Pelatihan';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Harga')
                    ->collapsible()
                    ->schema([
                        Forms\Components\Select::make('city_id')
                            ->createOptionForm([
                                Section::make('Kota')
                                    ->collapsible()
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->label('Kota Pelatihan')
                                            ->unique(ignoreRecord: true)
                                            ->required()
                                            ->maxLength(255),
                                    ]),
                            ])
                            ->relationship('city', 'name')
                            ->label('Kota Pelatihan')
                            ->preload()
                            ->required()
                            ->searchable(),
                        Forms\Components\Select::make('training_type_id')
                            ->createOptionForm([
                                Section::make('Jenis Pelatihan')
                                    ->collapsible()
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->label('Jenis Pelatihan USG')
                                            ->unique(ignoreRecord: true)
                                            ->required()
                                            ->maxLength(255),
                                    ]),
                            ])
                            ->relationship('trainingType', 'name')
                            ->label('Jenis Pelatihan')
                            ->preload()
                            ->required()
                            ->searchable(),
                        Forms\Components\TextInput::make('price')
                            ->label('Harga Pelatihan')
                            ->prefix('Rp')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('place')
                            ->label('Tempat Pelatihan')
                            ->required(),
                        Forms\Components\DatePicker::make('start_date')
                            ->label('Tanggal Mulai Pelatihan')
                            ->required(),
                        Forms\Components\DatePicker::make('end_date')
                            ->label('Tanggal Berakhir Pelatihan')
                            ->required(),
                    ])
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->paginationPageOptions([25, 50, 100, 250])
            ->defaultPaginationPageOption(25)
            ->recordTitleAttribute('price')
            ->columns([
                Tables\Columns\TextColumn::make('city.name')
                    ->label('Kota Pelatihan')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('trainingType.name')
                    ->label('Jenis Pelatihan')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Harga Pelatihan')
                    ->sortable()
                    ->searchable()
                    ->money('IDR'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
