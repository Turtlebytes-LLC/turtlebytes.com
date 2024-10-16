<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers\PostCommentsRelationManager;
use App\Models\Post;
use Carbon\Carbon;
use Exception;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Blog';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('Post')->schema([
                    Forms\Components\TextInput::make('slug')
                        ->unique(Post::class, ignoreRecord: true)
                        ->disabledOn('edit')
                        ->alphaDash()
                        ->helperText('This is automatically set based on the title'),
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

                Forms\Components\Grid::make(1)->schema([
                    Forms\Components\Repeater::make('comments')
                        ->itemLabel(fn (array $state) => (new Carbon($state['created_at']))->format('F j, Y, g:i a'))
                        ->relationship()
                        ->schema([
                            Forms\Components\TextInput::make('text'),

                            Forms\Components\Group::make()->relationship('author')->schema([
                                Forms\Components\TextInput::make('name')->label('Author'),
                            ]),
                        ])
                        ->visibleOn('view'),
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
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('tags'),
                Tables\Columns\TextColumn::make('author.name')->label('Author'),
                Tables\Columns\TextColumn::make('blog.title')->label('Blog'),
                Tables\Columns\TextColumn::make('comments_count')->label('Comment Count')->counts('comments'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\SelectFilter::make('blog')->relationship('blog', 'title'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                //                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            PostCommentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit'   => Pages\EditPost::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with('blog', 'author', 'comments.author')
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
