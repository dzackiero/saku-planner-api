<?php

namespace App\Http\Controllers;

use App\Data\Sync\SyncData;
use App\Services\SyncService;

class SyncController extends Controller
{
    public function sync(SyncData $data, SyncService $service)
    {
        $message = $service->sync($data);
        return $this->successResponse(
            message: $message
        );
    }

    public function getSyncData(SyncService $service)
    {
        $data = $service->getSyncData();
        return $this->successResponse(
            data: $data
        );
    }
}
