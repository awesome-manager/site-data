<?php

namespace App\Models;

use Awesome\Foundation\Traits\Models\AwesomeModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MenuItem extends Model
{
    use AwesomeModel;

    protected $fillable = [
        'title',
        'site_page_id',
        'icon',
        'is_active',
        'sort',
    ];

    public function sitePage(): HasOne
    {
        return $this->hasOne(SitePage::class, 'id', 'site_page_id');
    }
}
