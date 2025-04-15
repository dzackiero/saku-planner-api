<?php

namespace App\Services;

use App\Data\Transaction\CreateTransactionData;
use App\Data\Transaction\CreateTransferData;
use App\Models\Transaction;
use App\Models\Transfer;
use App\Models\Wallet;
use App\TransactionType;

class TransactionService
{
    public function createTransaction(CreateTransactionData $formData)
    {
        \DB::beginTransaction();
        $transaction = Transaction::create($formData->toArray());
        if ($transaction->type === TransactionType::Expense) {
            $transaction->wallet->decrement('balance', $transaction->amount + $transaction->administration_fee);
        } else {
            $transaction->wallet->increment('balance', $transaction->amount);
        }
        \DB::commit();

        return $transaction->load('wallet');
    }

    public function createTransfer(CreateTransactionData $formData)
    {
        \DB::beginTransaction();

        $fromTransactionData = new CreateTransactionData(
            user_id: $formData->user_id,
            category_id: $formData->category_id,
            wallet_id: $formData->wallet_id,
            type: TransactionType::Expense,
            amount: $formData->amount + $formData->administration_fee,
            note: $formData->note
        );
        $fromTransaction = $this->createTransaction($fromTransactionData);

        $toTransactionData = new CreateTransactionData(
            user_id: $formData->user_id,
            category_id: $formData->category_id,
            wallet_id: $formData->to_wallet_id,
            type: TransactionType::Income,
            amount: $formData->amount,
            note: $formData->note
        );
        $toTransaction = $this->createTransaction($toTransactionData);

        $transfer = Transfer::create([
            'user_id' => $formData->user_id,
            'from_transaction_id' => $fromTransaction->id,
            'to_transaction_id' => $toTransaction->id,
            'note' => $formData->note,
        ]);
        \DB::commit();

        return $transfer;
    }

    public function getTransactions()
    {
        $page = request('page', 1);
        $perPage = request('per-page', 15);
        $query = request('search', "");
        $orderBy = request('order', 'created_at');
        $direction = request('direction', 'desc');

        $transactions = Transaction::query()
            ->where('note', 'like', "%$query%")
            ->orderBy($orderBy, $direction);

        // $transfers = Transfer::query()
        //     ->select('')
        //     ->where('note', 'like', "%$query%")
        //     ->orderBy($orderBy, $direction);

        // ->paginate(perPage: $perPage, page: $page)
        //     ->withQueryString();
    }
}
