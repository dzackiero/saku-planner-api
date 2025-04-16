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
            'wallet' => $this->wallet,
            'to_wallet' => $this->toWallet,
            'category' => $this->category,
            'type' => $this->type,
            'amount' => $this->amount,
            'note' => $this->note,
        ];
    }
}
