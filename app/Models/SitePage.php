<?php

namespace App\Models;

use Awesome\Foundation\Traits\Models\AwesomeModel;
use Illuminate\Database\Eloquent\Model;

class SitePage extends Model
{
    use AwesomeModel;

    protected $fillable = [
        'title',
        'code',
        'link',
        'is_active',
    ];
}
