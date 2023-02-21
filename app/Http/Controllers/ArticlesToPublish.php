<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ForeignTag;
use App\Models\Website;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

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
        $foreignTags = ForeignTag::query()
            ->leftJoin('foreign_tag_maps', function (JoinClause $join) use ($website) {
                $join->on('foreign_tags.id', '=', 'foreign_tag_maps.foreign_tag_id');
                $join->on('foreign_tag_maps.website_id', '=', DB::raw($website->id));
            })
            ->leftJoin('tags', 'foreign_tag_maps.tag_id', '=', 'tags.id')
            ->join('article_foreign_tag', 'foreign_tags.id', '=', 'article_foreign_tag.foreign_tag_id')
            ->whereIn('article_foreign_tag.article_id', $articles->map(fn($article) => $article->id))
            ->get([
                'article_foreign_tag.article_id',
                'article_foreign_tag.foreign_tag_id',
                'foreign_tags.id as foreign_tag_id',
                'foreign_tags.name as foreign_tag_name',
                'foreign_tags.slug as foreign_tag_slug',
                'tags.id as tag_id',
                'tags.slug as tag_slug',
                'tags.name as tag_name',
            ]);
        $tagsByArticleId = [];
        foreach ($foreignTags as $item) {
            $key = $item['article_id'];
            if (!array_key_exists($key, $tagsByArticleId)) {
                $tagsByArticleId[$key] = [];
            }
            $id = $item['foreign_tag_id'];
            $name = $item['foreign_tag_name'];
            $slug = $item['foreign_tag_slug'];
            if (!empty($item['tag_name'])) {
                $id = $item['tag_id'];
                $name = $item['tag_name'];
                $slug = $item['tag_slug'];
            }
            $tagsByArticleId[$key][] = [
                'id' => $id,
                'name' => $name,
                'slug' => $slug,
            ];
        }
        $articles->transform(function ($item) use ($tagsByArticleId) {
            if (array_key_exists($item->id, $tagsByArticleId)) {
                $item->foreign_tags = $tagsByArticleId[$item->id];
            }
            return $item;
        });
        return new JsonResponse(['articles' => $articles]);
    }
}
