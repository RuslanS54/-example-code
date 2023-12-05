<?php

namespace App\Enum;

class UserRolesEnum
{
    public const AUTHOR = 'author';
    public const READER = 'reader';
    public const ADMIN = 'admin';

    public static function localization(): array
    {
        return [
            self::AUTHOR => __('enum/user_roles.author'),
            self::ADMIN => __('enum/user_roles.admin'),
            self::READER => __('enum/user_roles.reader'),
        ];
    }
}
