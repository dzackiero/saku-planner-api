<?php

namespace App\Models;

use App\Enums\CategoryType;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $guarded = [];
    protected $casts = [
        'type' => CategoryType::class,
    ];

    /* Relationship */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
