<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

trait ApiResponse
{
    protected function apiResult(string $message, $data = null, bool $success = true, int $status = 200): JsonResponse
    {
        return response()->json([
            'success' => $success,
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    protected function apiException(Request $request, Throwable $exception): JsonResponse
    {
        $exception = $this->prepareException($exception);

        if (method_exists($exception, 'getStatusCode')) {
            $statusCode = $exception->getStatusCode();
        } else {
            $statusCode = 500;
        }

        return $this->apiResult($exception->getMessage(), [
            'code' => $exception->getCode(),
            'message' => $exception->getMessage(),
            'info' => $exception->getPrevious(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'trace' => $exception->getTrace(),
        ], false, $statusCode);
    }
}
