<?php

namespace Codebase\API\Http\Controllers\Domains\Diets;

use App\Domain\Diet\Models\Diet;
use App\Domain\Diet\Resources\DietResource;
use Codebase\API\Http\Controllers\APIController;

class ClientDietController extends APIController
{
    public function __invoke()
    {
        $diet = Diet::with([
            'meals.items.alternativesRecipes', 'meals.items.recipe', 'meals.items.activity',
        ])
                    ->where('client_id', auth()->id())
                    ->latest()
                    ->first();

        $diet?->forceFill(['with_next_meal' => true]);

        return $this->success(($diet ? new DietResource($diet) : null));
    }
}