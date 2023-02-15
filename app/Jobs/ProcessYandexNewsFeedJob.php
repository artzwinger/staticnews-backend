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
        $this->feed->update(['latest_processed_at' => Carbon::now()]);
        $url = $this->feed->url;
        $response = Http::withUserAgent(self::USERAGENT)->get($url);
        if ($response->status() !== 200) {
            throw new Exception('Cannot fetch ' . $url . ' for feed #' . $this->feed->id);
        }
        $xml = simplexml_load_string($response->body());
        $items = $xml->xpath('//item');
        foreach ($items as $item) {
            dispatch(new ProcessYandexFeedItem($item, $this->feed));
        }
    }
}
