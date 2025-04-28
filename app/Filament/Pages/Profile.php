<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class Profile extends EditProfile
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\FileUpload::make('avatar')
                            ->label('Foto')
                            ->circleCropper()
                            ->image()
                            ->imageEditor()
                            ->circleCropper()
                            ->directory('avatars')
                            ->moveFiles()
                            ->maxSize(500)
                            ->downloadable()
                            ->openable()
                            ->columnSpanFull()
                            ->afterStateUpdated(function ($state) {
                                if (! $state instanceof TemporaryUploadedFile) return;

                                // Delete old avatar if exists
                                $oldAvatar = auth()->user()->avatar;
                                if ($oldAvatar && Storage::exists($oldAvatar)) {
                                    Storage::delete($oldAvatar);
                                }
                            })
                            ->deleteUploadedFileUsing(function ($file, $record) {
                                if (
                                    $record?->avatar &&
                                    Storage::disk('public')->exists($record->avatar)
                                ) {
                                    Storage::disk('public')->delete($record->avatar);
                                }
                            }),
                        $this->getNameFormComponent(),
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                    ])
                    ->columns(1),
            ]);
    }
}
