<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Target extends Model
{
    use HasUuids, SoftDeletes;
    protected $guarded = [];

    /* Relationship */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function account()
    {
        return $this->hasOne(Account::class);
    }
}
