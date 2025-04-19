<?php

namespace App\Http\Resources\Saving;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SavingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $savingCount = $this->wallet->savings()->count();
        $balance = $this->wallet->balance;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'target' => $this->target,
            'wallet' => $this->wallet,
            'current_amount' => $balance / $savingCount,
            'target_months' => $this->target_months,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
