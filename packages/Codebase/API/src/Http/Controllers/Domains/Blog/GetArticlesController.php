<?php

namespace Codebase\API\Http\Controllers\Domains\Blog;

use App\Domain\Blog\Models\Article;
use App\Domain\Client\Resources\ArticleResource;
use Codebase\API\Http\Controllers\APIController;

class GetArticlesController extends APIController
{
    public function __invoke()
    {
        $articles = Article::with('media')->paginate();
        return $this->success(ArticleResource::paginate($articles));
    }
}