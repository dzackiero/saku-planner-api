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
        #[Nullable]
        public ?array $deleteAccounts = [],
        #[Nullable, DataCollectionOf(BudgetData::class)]
        public ?array $budgets = [],
        #[Nullable]
        public ?array $deleteBudgets = [],
        #[Nullable, DataCollectionOf(CategoryData::class)]
        public ?array $categories = [],
        #[Nullable]
        public ?array $deleteCategories = [],
        #[Nullable, DataCollectionOf(MonthBudgetData::class)]
        public ?array $monthBudgets = [],
        #[Nullable]
        public ?array $deleteMonthBudgets = [],
        #[Nullable, DataCollectionOf(TargetData::class)]
        public ?array $targets = [],
        #[Nullable]
        public ?array $deleteTargets = [],
        #[Nullable, DataCollectionOf(TransactionData::class)]
        public ?array $transactions = [],
        #[Nullable]
        public ?array $deleteTransactions = [],
    ) {
    }
}
