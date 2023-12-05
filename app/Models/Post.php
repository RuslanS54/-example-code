<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Ramsey\Collection\Collection;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 *
 * @property int $id;
 * @property string $title
 * @property string $text
 * @property string $image
 * @property string $slug
 * @property boolean $is_published
 * @property int $time_reading
 * @property int $view
 * @property-read User $user
 * @property-read Collection<Comment> $comments
 *
 * @mixin Eloquent
 */
class Post extends Model
{
    use HasFactory, HasSlug;

    protected $guarded = ['id'];

    protected $table = 'posts';

    public function user(): BelongsTo
    {
        return  $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function comments(): HasMany
    {
        return  $this->hasMany(Comment::class, 'comment_id', 'id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class)->using(PostTag::class);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->skipGenerateWhen(function () {
                return !empty($this->original['title']) && $this->original['title'] === $this->title;
            })
            ->saveSlugsTo('slug');
    }

    protected function ImageUrl(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->image != ''
                ? asset(Storage::url($this->image))
                : BlogSetting::getSetting()->default_post_image_url,
        );
    }

}
