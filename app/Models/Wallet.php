<?php

namespace App\Models;

use App\WalletType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasUuids;
    protected $guarded = [];
    protected $casts = [
        'type' => WalletType::class,
    ];

    /* Relationship */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
