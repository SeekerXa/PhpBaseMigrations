<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\JsonResponse;

trait ControllerResponse
{
    public function jsonResponse(mixed $data = null, int $code = 200): JsonResponse
    {
        return response()->json($data)->setStatusCode($code);
    }

    public function jsonCreate(?array $data = null): JsonResponse
    {
        return $this->jsonResponse($data, 201);
    }

    public function jsonUpdate(?array $data = null): JsonResponse
    {
        return $this->jsonResponse($data, 200);
    }
    public function jsonDelete(?array $data = null): JsonResponse
    {
        return $this->jsonResponse($data, 204);
    }
    public function jsonValidate(?array $data = null): JsonResponse
    {
        return $this->jsonResponse($data, 422);
    }

    public function jsonMissingId(?array $data = null): JsonResponse
    {
        return $this->jsonResponse($data, 404);
    }
}