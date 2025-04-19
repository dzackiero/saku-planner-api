<?php

namespace App\Models;

use App\Enums\WalletType;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wallet extends Model
{

    protected $guarded = [];
    protected $casts = [
        'type' => WalletType::class,
    ];

    /* Relationship */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function savings(): HasMany
    {
        return $this->hasMany(Saving::class);
    }
}
