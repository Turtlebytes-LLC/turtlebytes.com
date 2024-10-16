<?php

namespace App\Filament\Resources\BlogResource\RelationManagers;

use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class PostsRelationManager extends RelationManager
{
    protected static string $relationship = 'posts';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('Post')->schema([
                    Forms\Components\TextInput::make('slug')
                        ->unique(Post::class, ignoreRecord: true)
                        ->disabledOn('edit')
                        ->alphaDash()
                        ->helperText('This is automatically set based on the title'),
                    Forms\Components\Hidden::make('author_id')
                        ->default(auth()->id()),
                    Forms\Components\TextInput::make('title')
                        ->live(onBlur: true)
                        ->required()
                        ->autofocus()
                        ->afterStateUpdated(function (
                            Set $set,
                            string $operation,
                            string $state
                        ): void {
                            if ($operation === 'create') {
                                $set('slug', Str::slug($state));
                            }
                        }),
                    Forms\Components\TagsInput::make('tags'),
                ]),

                Forms\Components\Fieldset::make('Content')->columns(1)->schema([
                    Forms\Components\MarkdownEditor::make('body')->required(),
                ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('slug')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('title')->sortable()->searchable(),
                //                Tables\Columns\TextColumn::make('description')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('tags')->sortable()->searchable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->modifyQueryUsing(fn (Builder $query) => $query->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]));
    }
}
