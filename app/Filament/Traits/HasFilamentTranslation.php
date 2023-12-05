<?php

namespace App\Filament\Traits;

use Illuminate\Support\Str;

trait HasFilamentTranslation
{
    public static function getModelLabel(): string
    {
        return __('filament/'.Str::slug(class_basename(static::$model)).'.label.model');
    }

    public static function getNavigationLabel(): string
    {
        return __('filament/'.Str::slug(class_basename(static::$model)).'.label.navigation');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament/'.Str::slug(class_basename(static::$model)).'.label.plural_model');
    }

    public static function getLabel(): ?string
    {
        return __('filament/'.Str::slug(class_basename(static::$model)).'.label.label');
    }

    public static function getPluralLabel(): ?string
    {
        return __('filament/'.Str::slug(class_basename(static::$model)).'.label.plural');
    }

    public static function getNavigationSort(): ?int
    {
        return config('filament.sort.'.Str::slug(class_basename(static::$model)));
    }
}


