<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Saving extends Model
{

    protected $guarded = [];

    /* Relationships */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
