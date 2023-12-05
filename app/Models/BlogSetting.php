<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * @property string $id
 * @property string $default_post_image
 *
 * @property-read string $default_post_image_url
 */
class BlogSetting extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected function DefaultPostImageUrl(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->default_post_image != ''
                ? asset(Storage::url($this->default_post_image))
                : null,
        );
    }

    public static function getSetting(): self
    {
        return self::query()->get()->first();
    }

}
