<?php
namespace App\Data\Sync;

use App\Data\AccountData;
use App\Data\BudgetData;
use App\Data\CategoryData;
use App\Data\MonthBudgetData;
use App\Data\TargetData;
use App\Data\TransactionData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class SyncData extends Data
{
    public function __construct(
        #[DataCollectionOf(AccountData::class)]
        public array $accounts,
        #[DataCollectionOf(BudgetData::class)]
        public array $budgets,
        #[DataCollectionOf(CategoryData::class)]
        public array $categories,
        #[DataCollectionOf(MonthBudgetData::class)]
        public array $monthBudgets,
        #[DataCollectionOf(TargetData::class)]
        public array $targets,
        #[DataCollectionOf(TransactionData::class)]
        public array $transactions,
    ) {
    }
}
