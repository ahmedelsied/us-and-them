<?php

namespace Codebase\API\Http\Controllers;

use Codebase\API\Support\Services\APIResponse\ApiResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class APIController extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    public function success(mixed $message, int $code = 200, array $extra = []): JsonResponse
    {
        return ApiResponse::success($message, $code, $extra);
    }

    public function error(mixed $message, int $code = 400, array $extra = []): JsonResponse
    {
        return ApiResponse::error($message, $code, $extra);
    }

    public function executed(): JsonResponse
    {
        return ApiResponse::executed();
    }
}