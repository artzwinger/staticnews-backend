<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PublishArticles extends Controller
{
    /**
     * @param $websiteId
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke($websiteId, Request $request): JsonResponse
    {
        $ids = $request->post('articles_ids');
        $articles = Article::whereId($ids)->get(['id']);
        Article::whereId($ids)->update(['updated' => false, 'published_at' => Carbon::now()]);
        $updatedArticlesIds = $articles->map(fn($article) => (string)$article->id);
        $notFound = array_diff($ids, $updatedArticlesIds);
        return new JsonResponse(['published' => $updatedArticlesIds, 'not_found' => $notFound]);
    }
}
