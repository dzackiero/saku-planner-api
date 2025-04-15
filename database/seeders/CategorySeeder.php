<?php

namespace Database\Seeders;

use App\CategoryType;
use App\Models\User;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        if ($user) {
            $user->categories()->createMany([
                // INCOME
                ['name' => 'Income 1', 'type' => CategoryType::INCOME->value],
                ['name' => 'Income 2', 'type' => CategoryType::INCOME->value],
                ['name' => 'Income 3', 'type' => CategoryType::INCOME->value],

                // EXPENSE
                ['name' => 'Expense 1', 'type' => CategoryType::EXPENSE->value],
                ['name' => 'Expense 2', 'type' => CategoryType::EXPENSE->value],
                ['name' => 'Expense 3', 'type' => CategoryType::EXPENSE->value],
            ]);
        }
    }
}
