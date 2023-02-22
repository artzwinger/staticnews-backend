<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PublishArticles extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
//        $ids = $request->post('articles_ids');
//        $articles = Article::whereId($ids)->get(['id']);
//        Article::query()->whereIn('id', $ids)->update(['updated' => false, 'published_at' => Carbon::now()]);
//        $updatedArticlesIds = $articles->map(fn($article) => (string)$article->id);
//        return new JsonResponse(['published' => $updatedArticlesIds]);
        return new JsonResponse(['published' => []]);
    }
}
