<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use App\Filament\Resources\ProductResource;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class DescriptionsRelationManager extends RelationManager
{
    protected static string $relationship = 'descriptions';
    protected static ?string $pluralLabel = 'Deskripsi Produk';
    protected static ?string $label = 'Deskripsi Produk';
    protected static ?string $pluralModelLabel = 'Deskripsi Produk';
    protected static ?string $modelLabel = 'Deskripsi Produk';
    protected static ?string $title = 'Deskripsi Produk';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Deskripsi Produk')
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('judul_deskripsi')
                            ->label('Nama Deskripsi')
                            ->unique(ignoreRecord: true)
                            ->required()
                            ->maxLength(255),
                        TinyEditor::make('description')
                            ->showMenuBar(1)
                            ->required()
                            ->label('Deskripsi')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('judul_deskripsi')
            ->columns([
                Tables\Columns\TextColumn::make('judul_deskripsi')
                    ->label('Judul Deskripsi'),
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
