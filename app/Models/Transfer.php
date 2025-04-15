<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $guarded = [];

    public function fromTransaction()
    {
        return $this->belongsTo(Transaction::class, 'from_transaction_id');
    }

    public function toTransaction()
    {
        return $this->belongsTo(Transaction::class, 'to_transaction_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
