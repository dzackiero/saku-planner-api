<?php

namespace App;

enum TransactionType: string
{
    case Income = 'income';
    case Expense = 'expense';
}
