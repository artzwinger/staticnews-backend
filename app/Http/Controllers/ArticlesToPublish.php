<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Website;
use Illuminate\Http\JsonResponse;

class ArticlesToPublish extends Controller
{
    /**
     * @param $websiteCode
     * @return JsonResponse
     */
    public function __invoke($websiteCode): JsonResponse
    {
        $website = Website::whereCode($websiteCode)->first();
        $articles = Article::whereWebsiteId($website->id)
            ->toPublish()->get();
        return new JsonResponse(['articles' => $articles]);
    }
}
