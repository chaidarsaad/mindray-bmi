<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutResource\Pages;
use App\Filament\Resources\AboutResource\RelationManagers;
use App\Models\About;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AboutResource extends Resource
{
    protected static ?string $model = About::class;
    protected static ?string $pluralLabel = 'Data CV';
    protected static ?string $navigationLabel = 'Data CV';
    protected static ?string $navigationGroup = 'Data Utama';
    protected static ?int $navigationSort = 0;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Data CV')
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama CV')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->label('Email CV')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone_number')
                            ->helperText('isi nomor setelah +62')
                            ->prefix('+62')
                            ->label('Nomor HP CV')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('address')
                            ->label('Alamat CV')
                            ->required()
                            ->maxLength(255),
                    ]),
                Section::make('Logo CV')
                    ->collapsible()
                    ->schema([
                        Forms\Components\FileUpload::make('logo')
                            ->label('')
                            ->helperText('Untuk menjaga performa website, disarankan format gambar .webp')
                            ->image()
                            ->required(),
                    ]),
                Section::make('Footer')
                    ->collapsible()
                    ->schema([
                        Forms\Components\Textarea::make('trusted')
                            ->label('Kalimat Footer'),
                        Forms\Components\TextInput::make('instagram')
                            ->url()
                            ->label('Link Instagram'),
                        Forms\Components\TextInput::make('facebook')
                            ->url()
                            ->label('Link Facebook'),
                        Forms\Components\TextInput::make('youtube')
                            ->url()
                            ->label('Link Youtube'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->paginated(false)
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama CV')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email CV')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->prefix('+62')
                    ->label('Nomor HP CV')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->label('Alamat CV')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ImageColumn::make('logo')
                    ->label('Logo CV'),
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
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListAbouts::route('/'),
            'create' => Pages\CreateAbout::route('/create'),
            'edit' => Pages\EditAbout::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return About::count() < 1;
    }
}
