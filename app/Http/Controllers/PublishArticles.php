<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PublishArticles extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        DB::listen(function (QueryExecuted $event) {
            Log::info(
                'SQL Query',
                [
                    $event->sql,
                    $event->bindings,
                    $event->time,
                ]
            );
        });
        $ids = $request->post('articles_ids');
        Log::info(
            'Publish articles',
            [
                'ids' => json_encode($ids)
            ]
        );
        $articles = Article::whereId($ids)->get(['id']);
        Article::query()->whereIn('id', $ids)->update(['updated' => false, 'published_at' => Carbon::now()]);
        $updatedArticlesIds = $articles->map(fn($article) => (string)$article->id);
        return new JsonResponse(['published' => $updatedArticlesIds]);
    }
}
