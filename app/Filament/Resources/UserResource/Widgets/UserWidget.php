<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\User;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserWidget extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(
                User::query()
                    ->with('roles')
                    ->withoutGlobalScope(SoftDeletingScope::class)
            )
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('email'),
            ]);
    }
}
