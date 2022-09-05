<?php

namespace Codebase\API\Resources;

use Codebase\API\Support\Traits\WithPagination;
use Illuminate\Http\Resources\Json\JsonResource;

class BaseResource extends JsonResource
{
    use WithPagination;

    public function toArray($request)
    {
        return [

        ];
    }
}