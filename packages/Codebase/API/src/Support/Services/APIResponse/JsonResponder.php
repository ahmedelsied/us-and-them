<?php

namespace Codebase\API\Support\Services\APIResponse;

use Illuminate\Http\JsonResponse;

class JsonResponder
{
    public function success($body, int $code = 200, mixed $extra = []): JsonResponse
    {
        return $this->base($body, $code, $extra);
    }

    public function error($body, int $code = 400, mixed $extra = []): JsonResponse
    {
        return $this->base($body, $code, $extra, false);
    }

    public function executed(): JsonResponse
    {
        return $this->success(__('Request executed successfully'));
    }

    public function failed(): JsonResponse
    {
        return $this->error(__('Request failed to be executed'));
    }

    /**
     * @param $body
     * @param  int  $code
     * @param  array  $extra
     * @param  bool  $status
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private function base($body, int $code, mixed $extra, bool $status = true): JsonResponse
    {
        $bodyAttribute = $status ? 'data' : 'message';
        $response = [
            'value'        => $status,
            $bodyAttribute => $body,
            'code'         => $code,
        ];

        if (!empty($extra)) {
            $response['extra'] = $extra;
        }

        return response()->json($response);
    }
}
