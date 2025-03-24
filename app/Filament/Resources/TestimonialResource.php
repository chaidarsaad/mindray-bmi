<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Filament\Resources\TestimonialResource\RelationManagers;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;
    protected static ?string $pluralLabel = 'Testimonial';
    protected static ?string $navigationLabel = 'Testimonial';
    protected static ?string $navigationGroup = 'Data Utama';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Testimonial')
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('title')
                            ->helperText('Contoh: Dr Spesialis A')
                            ->label('Gelar (opsional)')
                            ->maxLength(255)
                            ->default(null),
                        Forms\Components\Textarea::make('review')
                            ->label('Review')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('subreview')
                            ->label('Kutipan (opsional)')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('rating')
                            ->label('Bintang')
                            ->maxValue(5)
                            ->maxLength(1)
                            ->required()
                            ->numeric(),
                        Forms\Components\Toggle::make('is_show')
                            ->label('Tampilkan review?')
                            ->default(1)
                            ->required(),
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
                    ->label('Nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Gelar')
                    ->searchable(),
                Tables\Columns\TextColumn::make('rating')
                    ->label('Bintang')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('is_show')
                    ->label('Tampilkan review?'),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
