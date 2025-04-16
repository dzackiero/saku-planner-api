<?php

namespace App\Http\Controllers;

use App\Data\Saving\CreateSavingData;
use App\Data\Saving\UpdateSavingData;
use App\Services\SavingService;
use App\Models\Saving;

class SavingController extends Controller
{
    public function index(SavingService $service)
    {
        $savings = $service->getAllSavings();
        return $this->successResponse($savings);
    }

    public function store(SavingService $service, CreateSavingData $request)
    {
        $saving = $service->createSaving($request);
        return $this->successResponse($saving);
    }

    public function show(SavingService $service, Saving $saving)
    {
        $saving = $service->getSaving($saving);
        return $this->successResponse($saving);
    }
    public function update(SavingService $service, UpdateSavingData $request, Saving $saving)
    {
        $saving = $service->updateSaving($saving, $request);
        return $this->successResponse($saving);
    }

    public function destroy(SavingService $service, Saving $saving)
    {
        $service->deleteSaving($saving);
        return $this->successResponse();
    }
}
