<?php

namespace App\Jobs;

use App\Models\Article;
use App\Models\SourceFeed;
use Carbon\Carbon;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProcessYandexNewsFeedJob implements ShouldQueue, IProcessFeedJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private SourceFeed $feed;

    const USERAGENT = 'Mozilla/5.0 (compatible; YandexNews/4.0; +http://yandex.com/bots) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36';

    public function __construct(SourceFeed $feed)
    {
        $this->feed = $feed;
    }

    /**
     * @return void
     * @throws Exception
     */
    public function handle(): void
    {
        $url = $this->feed->url;
        $response = Http::withUserAgent(self::USERAGENT)->get($url);
        if ($response->status() !== 200) {
            throw new Exception('Cannot fetch ' . $url . ' for feed #' . $this->feed->id);
        }
        $xml = simplexml_load_string($response->body());
        $items = $xml->xpath('//item');
        foreach ($items as $item) {
            try {
                $image = $item->xpath('//enclosure') ? $item?->enclosure[0]['url'] : null;
                if ($image) {
                    $image = $this->downloadImage($image);
                }
                $slug = Str::slug(Str::transliterate((string)$item?->title));
                $foreignTags = [];
                if ($item?->category) {
                    $foreignTags[] = (string)$item->category;
                }
                $content = (string)$item->xpath('//yandex:full-text')[0];
                Article::factory()->create([
                    'website_id' => $this->feed->website_id,
                    'source_feed_id' => $this->feed->id,
                    'slug' => $slug,
                    'title' => (string)$item?->title,
                    'description' => (string)$item?->description,
                    'content' => $content,
                    'image_filename' => $image,
                    'foreign_created_at' => Carbon::parse((string)$item->pubDate),
                    'foreign_tags' => $foreignTags,
                ]);
            } catch (\Exception $exception) {
            }
        }
    }

    private function downloadImage($imageSrc): string
    {
        $image = file_get_contents($imageSrc);
        $filename = md5($imageSrc) . '.' . $this->getImageExt($imageSrc);
        Storage::disk('public')->put($filename, $image);
        return $filename;
    }

    private function getImageExt($imageSrc): string
    {
        $parts = explode('.', $imageSrc);
        return end($parts);
    }
}
