<?php

namespace App\Models;

use App\Traits\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Post
 *
 * @method static whereHasTags(mixed $request)
 */
class Post extends Model
{
    use BaseModel, HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'body',
        'tags',
        'blog_id',
        'author_id',
    ];

    protected $casts = [
        'tags' => 'array',
    ];

    public function blog(): BelongsTo
    {
        return $this->belongsTo(Blog::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->orderBy(column: 'created_at', direction: 'desc');
    }

    public function some_comments(): HasMany
    {
        return $this->comments()->limit(5);
    }

    public function scopeWhereHasTags($query, $tags)
    {
        return $query->whereJsonContains('tags', $tags);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
