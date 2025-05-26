<?php

namespace App\Models;


use App\Enums\TransactionType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasUuids;
    protected $guarded = [];
    protected $casts = [
        'type' => TransactionType::class,
    ];

    /* Relationship */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function wallet()
    {
        return $this->belongsTo(Account::class);
    }

    public function toWallet(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'to_wallet_id');
    }
}
