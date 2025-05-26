<?php

namespace App\Models;

use App\Enums\CategoryType;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasUuids, SoftDeletes;
    protected $guarded = [];

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
