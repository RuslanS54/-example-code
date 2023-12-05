<?php

namespace App\Models;

use App\Http\Middleware\TrimStrings;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PostTag extends Pivot
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'post_tables';
}
