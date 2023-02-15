<?php

namespace App\Jobs;

use App\Models\Article;
use App\Models\SourceFeed;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class ProcessYandexFeedItem implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private \SimpleXMLElement $item;
    private SourceFeed $feed;

    /**
     * @return void
     */
    public function __construct(\SimpleXMLElement $item, SourceFeed $feed)
    {
        $this->item = $item;
        $this->feed = $feed;
    }

    /**
     * @return void
     */
    public function handle(): void
    {
        $slug = Str::slug(Str::transliterate((string)$this->item?->title));
        if (Article::whereSlug($slug)->exists()) {
            return;
        }
        $foreignTags = [];
        if ($this->item?->category) {
            $foreignTags[] = (string)$this->item->category;
        }
        $content = (string)$this->item->xpath('//yandex:full-text')[0];
        $article = Article::factory()->create([
            'website_id' => $this->feed->website_id,
            'source_feed_id' => $this->feed->id,
            'slug' => $slug,
            'title' => (string)$this->item?->title,
            'description' => (string)$this->item?->description,
            'content' => $content,
            'foreign_created_at' => Carbon::parse((string)$this->item->pubDate),
            'foreign_tags' => $foreignTags,
        ]);
        $image = $this->item->xpath('//enclosure') ? $this->item?->enclosure[0]['url'] : null;
        if ($article->id) {
            dispatch(new DownloadImageForArticle($article, $image));
        }
    }
}
