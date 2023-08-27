<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Models\User;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile;

class ProfileUser extends EditProfile
{
    public function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')->required(),
            TextInput::make('email')->email()->required()->unique(table: User::class, ignoreRecord: true),

            Actions::make([
                Action::make('Change Password')->form([
                    TextInput::make('password')->password()->required()->confirmed(),
                    TextInput::make('password_confirmed')->password()->required(),
                ]),
            ]),
        ]);
    }
}
