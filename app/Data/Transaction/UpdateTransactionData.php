<?php

namespace App\Data\Transaction;

use App\Enums\TransactionType;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\Validation\Date;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class UpdateTransactionData extends Data
{
    public function __construct(
        #[Exists('categories', 'id')]
        public string|Optional $category_id = null,
        #[Exists('wallets', 'id')]
        public string|Optional $wallet_id,
        #[Exists('wallets', 'id'), Nullable]
        public string|Optional $to_wallet_id = null,
        public TransactionType|Optional $type,
        #[Min(0)]
        public float|Optional $amount,
        #[Nullable]
        public string|Optional $note,
        #[Nullable, Date]
        public Carbon|Optional $transaction_at,
    ) {
    }
}
