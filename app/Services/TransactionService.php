<?php

namespace App\Services;

use App\Data\Transaction\CreateTransactionData;
use App\Data\Transaction\UpdateTransactionData;
use App\Http\Resources\Transaction\TransactionResource;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Enums\TransactionType;

class TransactionService
{
    public function createTransaction(CreateTransactionData $formData)
    {
        \DB::beginTransaction();
        $transaction = Transaction::create($formData->toArray());
        if ($transaction->type === TransactionType::Expense) {
            $transaction->wallet->decrement('balance', $transaction->amount);
        }
        if ($transaction->type === TransactionType::Income) {
            $transaction->wallet->increment('balance', $transaction->amount);
        }

        if ($transaction->type === TransactionType::Transfer) {
            $transaction->wallet->decrement('balance', $transaction->amount);
            $transaction->toWallet->increment('balance', $transaction->amount);
            $this->createTransaction(
                new CreateTransactionData(
                    user_id: $formData->user_id,
                    wallet_id: $formData->to_wallet_id,
                    amount: $formData->administration_fee,
                    type: TransactionType::Expense,
                    transaction_at: $formData->transaction_at,
                )
            );
        }
        \DB::commit();

        return TransactionResource::make($transaction->load(['wallet', 'toWallet', 'category']));
    }

    public function getTransactions()
    {
        $page = request('page', 1);
        $perPage = request('per-page', 15);
        $query = request('search', "");
        $orderBy = request('order', 'created_at');
        $direction = request('direction', 'desc');

        $transactions = Transaction::with(['category', 'wallet', 'toWallet'])
            ->where('note', 'like', "%$query%")
            ->where('user_id', auth()->id())
            ->orderBy($orderBy, $direction)
            ->paginate(perPage: $perPage, page: $page);

        $transactions = TransactionResource::collection($transactions)->resource;
        return $transactions;
    }

    public function getTransaction(Transaction $transaction)
    {
        return TransactionResource::make($transaction->load(['category', 'wallet', 'toWallet']));
    }

    public function updateTransaction(Transaction $transaction, UpdateTransactionData $formData)
    {
        \DB::beginTransaction();
        $originalAmount = $transaction->amount;
        $originalType = $transaction->type;
        $originalWalletId = $transaction->wallet_id;
        $originalToWalletId = $transaction->to_wallet_id;

        $transaction->fill($formData->toArray());

        if ($originalType === TransactionType::Expense) {
            $originalWallet = Wallet::find($originalWalletId);
            $originalWallet->increment('balance', $originalAmount);
        }

        if ($originalType === TransactionType::Income) {
            $originalWallet = Wallet::find($originalWalletId);
            $originalWallet->decrement('balance', $originalAmount);
        }

        if ($originalType === TransactionType::Transfer) {
            $originalWallet = Wallet::find($originalWalletId);
            $originalToWallet = Wallet::find($originalToWalletId);
            $originalWallet->increment('balance', $originalAmount);
            $originalToWallet->decrement('balance', $originalAmount);
        }

        // Apply new transaction effects
        if ($transaction->type === TransactionType::Expense) {
            $transaction->wallet->decrement('balance', $transaction->amount);
        }

        if ($transaction->type === TransactionType::Income) {
            $transaction->wallet->increment('balance', $transaction->amount);
        }

        if ($transaction->type === TransactionType::Transfer) {
            $transaction->wallet->decrement('balance', $transaction->amount);
            $transaction->toWallet->increment('balance', $transaction->amount);
        }

        $transaction->save();
        \DB::commit();

        return TransactionResource::make($transaction->load(['category', 'wallet', 'toWallet']));
    }

    public function deleteTransaction(Transaction $transaction)
    {
        \DB::beginTransaction();

        if ($transaction->type === TransactionType::Expense) {
            $transaction->wallet->increment('balance', $transaction->amount);
        }

        if ($transaction->type === TransactionType::Income) {
            $transaction->wallet->decrement('balance', $transaction->amount);
        }

        if ($transaction->type === TransactionType::Transfer) {
            $transaction->wallet->increment('balance', $transaction->amount);
            $transaction->toWallet->decrement('balance', $transaction->amount);
        }

        $transaction->delete();
        \DB::commit();
    }
}
