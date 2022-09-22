<?php

namespace App\API\Http\Controllers;

use Codebase\API\Support\Services\APIResponse\ApiResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;

class APIController extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    public function success(mixed $message, int $code = 200, mixed $extra = []): JsonResponse
    {
        $this->setAr();
        return ApiResponse::success($message, $code, $extra);
    }

    public function error(mixed $message, int $code = 400, mixed $extra = []): JsonResponse
    {
        $this->setAr();
        return ApiResponse::error($message, $code, $extra);
    }

    public function successfulRequest(
        ?string $route = null,
        bool $asJson = true
    ): RedirectResponse|JsonResponse {
        if ($asJson) {
            return ApiResponse::success(__('Request executed successfully'));
        }
        toast(__('Request executed successfully'), 'success');

        return redirect()->route($route ?: "{$this->path}.index");
    }

    public function executed(): JsonResponse
    {
        $this->setAr();
        return ApiResponse::executed();
    }

    private function setAr()
    {
        app()->setLocale('ar');
    }

    protected function validationAction(): array
    {
        return isset($this->formRequest) && class_exists($this->formRequest)
            ? app($this->formRequest)->validated() : request()->validate($this->rules());
    }

}