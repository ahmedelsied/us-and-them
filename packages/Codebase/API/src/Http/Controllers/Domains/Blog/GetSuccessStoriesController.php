<?php

namespace Codebase\API\Http\Controllers\Domains\Blog;

use App\Domain\Blog\Models\SuccessStory;
use App\Domain\Client\Resources\SuccessStoryResource;
use Codebase\API\Http\Controllers\APIController;

class GetSuccessStoriesController extends APIController
{
    public function __invoke()
    {
        $successStories = SuccessStory::with('media')->paginate();
        return $this->success(SuccessStoryResource::paginate($successStories));
    }
}