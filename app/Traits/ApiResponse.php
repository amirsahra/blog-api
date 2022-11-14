<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    protected function apiResult(string $message, array $data = null, bool $success = true, int $status = 200): JsonResponse
    {
        return response()->json([
            'success' => $success,
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $status);
    }
}
