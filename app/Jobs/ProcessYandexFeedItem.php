<?php

namespace App\Jobs;

use App\Models\Article;
use App\Models\ForeignTag;
use App\Models\SourceFeed;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProcessYandexFeedItem implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private SourceFeed $feed;
    private string $item;

    /**
     * @return void
     */
    public function __construct(string $item, SourceFeed $feed)
    {
        $this->feed = $feed;
        $this->item = $item;
    }

    /**
     * @return void
     */
    public function handle(): void
    {
        $item = simplexml_load_string($this->item);
        $item = $item->xpath('//item')[0];
        $slug = $this->getSlug((string)$item?->title);
        if (Article::whereSlug($slug)->exists()) {
            return;
        }
        $foreignTags = [];
        if ($item?->category) {
            $foreignTags[] = (string)$item->category;
        }
        $content = (string)$item->xpath('//yandex:full-text')[0];
        $article = Article::factory()->create([
            'website_id' => $this->feed->website_id,
            'source_feed_id' => $this->feed->id,
            'slug' => $slug,
            'title' => (string)$item?->title,
            'description' => (string)$item?->description,
            'content' => $content,
            'foreign_created_at' => Carbon::parse((string)$item->pubDate),
        ]);
        $article->foreignTags()->attach(
            $this->getOrCreateForeignTagIds($foreignTags)
        );
        $image = $item->xpath('//enclosure') ? $item?->enclosure[0]['url'] : null;
        if ($article->id) {
            dispatch(new DownloadImageForArticle($article, $image));
        }
    }

    private function getOrCreateForeignTagIds($tags): array
    {
        return array_map(function ($tag) {
            return DB::transaction(function () use ($tag) {
                return ForeignTag::whereName($tag)->lockForUpdate()->firstOrCreate([
                    'name' => $tag,
                    'slug' => $this->getSlug($tag),
                ])->id;
            });
        }, $tags);
    }

    private function getSlug($name): string
    {
        return Str::slug(Str::transliterate($name));
    }
}
