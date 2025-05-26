<?php

namespace App\Models;

use App\Enums\CategoryType;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasUuids;
    protected $guarded = [];
    protected $casts = [
        'type' => CategoryType::class,
    ];

    /* Relationship */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function budgets()
    {
        return $this->hasOne(Budget::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
