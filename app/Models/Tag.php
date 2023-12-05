<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Ramsey\Collection\Collection;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * @property string $name
 *
 * @property-read Collection<Post> $posts
 * @mixin Eloquent
 */
class Tag extends Model
{
    use HasFactory, HasSlug;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->skipGenerateWhen(function () {
                return !empty($this->original['name']) && $this->original['name'] === $this->name;
            })
            ->saveSlugsTo('slug');
    }
    protected $guarded = ['id'];

    protected $table = 'tags';

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class)->using(PostTag::class);
    }
}
