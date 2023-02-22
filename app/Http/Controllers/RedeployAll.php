<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\JsonResponse;

class RedeployAll extends Controller
{
    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $ids = Article::query()->get(['id'])->pluck('id');
        Article::query()->whereIn('id', $ids)->update(['updated' => true]);
        return new JsonResponse(['redeployed' => $ids]);
    }
}
