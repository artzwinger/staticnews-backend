<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\JsonResponse;

class ArticlesToPublish extends Controller
{
    /**
     * @param $websiteId
     * @return JsonResponse
     */
    public function __invoke($websiteId): JsonResponse
    {
        $articles = Article::whereWebsiteId($websiteId)->toPublish()->get();
        return new JsonResponse($articles);
    }
}
