<?php

namespace App\Data\Transaction;

use App\TransactionType;
use Spatie\LaravelData\Attributes\FromAuthenticatedUserProperty;
use Spatie\LaravelData\Attributes\Validation\ExcludeWith;
use Spatie\LaravelData\Attributes\Validation\ExcludeWithout;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Attributes\Validation\RequiredUnless;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class CreateTransactionData extends Data
{
    public function __construct(
        #[FromAuthenticatedUserProperty('id')]
        public string $user_id,

        #[Exists('categories', 'id'), RequiredUnless('to_wallet_id')]
        public ?string $category_id = null,
        #[Exists('wallets', 'id')]
        public string $wallet_id,
        #[Exists('wallets', 'id'), Nullable]
        public ?string $to_wallet_id = null,
        public TransactionType $type,
        #[Min(0)]
        public float $amount,
        #[Min(0), Nullable, ExcludeWithout('to_wallet_id')]
        public float|Optional $administration_fee,

        public ?string $note,
    ) {
    }
}
