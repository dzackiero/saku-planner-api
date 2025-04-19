<?php

namespace App\Http\Resources\Transaction;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'wallet' => $this->wallet,
            'to_wallet' => $this->toWallet,
            'category' => $this->category,
            'amount' => $this->amount,
            'note' => $this->note,
        ];
    }
}
