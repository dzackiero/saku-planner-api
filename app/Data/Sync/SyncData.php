<?php
namespace App\Data\Sync;

use App\Data\AccountData;
use App\Data\BudgetData;
use App\Data\CategoryData;
use App\Data\MonthBudgetData;
use App\Data\TargetData;
use App\Data\TransactionData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Data;

class SyncData extends Data
{
    public function __construct(
        #[Nullable, DataCollectionOf(AccountData::class)]
        public ?array $accounts = [],
        #[Nullable, DataCollectionOf(BudgetData::class)]
        public ?array $budgets = [],
        #[Nullable, DataCollectionOf(CategoryData::class)]
        public ?array $categories = [],
        #[Nullable, DataCollectionOf(MonthBudgetData::class)]
        public ?array $monthBudgets = [],
        #[Nullable, DataCollectionOf(TargetData::class)]
        public ?array $targets = [],
        #[Nullable, DataCollectionOf(TransactionData::class)]
        public ?array $transactions = [],
    ) {
    }
}
