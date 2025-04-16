<?php

namespace App\Http\Controllers;

use App\Data\Transaction\CreateTransactionData;
use App\Data\Transaction\UpdateTransactionData;
use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(TransactionService $transactionService)
    {
        $transactions = $transactionService->getTransactions();
        return response()->json($transactions);
    }

    public function store(TransactionService $service, CreateTransactionData $request)
    {
        $transaction = $service->createTransaction($request);
        return $this->successResponse($transaction);
    }
    public function show(TransactionService $service, Transaction $transaction)
    {
        $transaction = $service->getTransaction($transaction);
        return $this->successResponse($transaction);
    }

    public function update(TransactionService $service, UpdateTransactionData $request, Transaction $transaction)
    {
        $transaction = $service->updateTransaction($transaction, $request);
        return $this->successResponse($transaction);
    }

    public function destroy(TransactionService $service, Transaction $transaction)
    {
        $service->deleteTransaction($transaction);
        return $this->successResponse();
    }
}
