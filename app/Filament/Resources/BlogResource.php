<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogResource\Pages;
use App\Filament\Resources\BlogResource\RelationManagers\PostsRelationManager;
use App\Models\Blog;
use Exception;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Str;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Blog';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Owner Information')
                    ->columns(1)
                    ->visible(fn (string $operation) => $operation === 'edit')
                    ->relationship('author')
                    ->schema([
                        TextInput::make('name')->disabled()->inlineLabel(),
                        TextInput::make('email')->disabled()->inlineLabel()->email(),
                    ]),

                Fieldset::make('Blog Identifier')->schema([
                    TextInput::make('slug')
                        ->unique(Blog::class, ignoreRecord: true)
                        ->readOnly()
                        ->alphaDash()
                        ->helperText('This is automatically set based on the title'),
                ]),

                Fieldset::make('Blog Information')->schema([
                    TextInput::make('title')
                        ->live(onBlur: true)
                        ->required()
                        ->autofocus()
                        ->afterStateUpdated(function (
                            Set $set,
                            string $state
                        ) {
                            $set('slug', Str::slug($state));
                        }),
                    TextInput::make('description'),
                    TagsInput::make('tags'),
                ]),
            ]);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('slug')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('description')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->searchable()->sortable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            PostsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'edit'   => Pages\EditBlog::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with(['author'])
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
