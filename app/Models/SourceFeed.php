<?php

namespace App\Models;

use App\Jobs\IProcessFeedJob;
use App\Jobs\ProcessGoogleNewsFeedJob;
use App\Jobs\ProcessMediastackFeedJob;
use App\Jobs\ProcessYandexNewsFeedJob;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\SourceFeed
 *
 * @property int $id
 * @property int $website_id
 * @property string|null $url
 * @property string|null $keywords
 * @property string|null $countries
 * @property string|null $categories
 * @property string|null $sources
 * @property string|null $languages
 * @property string|null $sort
 * @property string $type
 * @property string|null $latest_article_marker
 * @property \Illuminate\Support\Carbon|null $latest_processed_at
 * @property-read \App\Models\Website $website
 * @method static \Database\Factories\SourceFeedFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|SourceFeed newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SourceFeed newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SourceFeed query()
 * @method static \Illuminate\Database\Eloquent\Builder|SourceFeed whereCategories($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SourceFeed whereCountries($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SourceFeed whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SourceFeed whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SourceFeed whereLanguages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SourceFeed whereLatestArticleMarker($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SourceFeed whereLatestProcessedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SourceFeed whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SourceFeed whereSources($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SourceFeed whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SourceFeed whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SourceFeed whereWebsiteId($value)
 * @mixin \Eloquent
 */
class SourceFeed extends Model
{
    use HasFactory;

    // how many articles to receive if there is no marker of the latest article saved
    const NO_MARKER_ARTICLES_FETCH_COUNT = 10;

    const SORT_PUBLISHED_DESC = 'published_desc';
    const SORT_PUBLISHED_ASC = 'published_asc';
    const SORT_POPULARITY = 'popularity';

    const TYPE_YANDEX_NEWS = 'yandex_news';
    const TYPE_GOOGLE_NEWS = 'google_news';
    const TYPE_MEDIASTACK = 'mediastack';

    const YANDEX_NEWS_FREQ_HOURS = 1;
    const GOOGLE_NEWS_FREQ_HOURS = 1;
    const MEDIASTACK_FREQ_HOURS = 1;

    public $timestamps = false;

    protected $fillable = [
        'website_id',
        'url',
        'latest_article_marker',
        'keywords',
        'sources',
        'categories',
        'countries',
        'languages',
        'sort',
        'type',
    ];

    protected $dates = [
        'latest_processed_at',
    ];

    public function website(): BelongsTo
    {
        return $this->belongsTo(Website::class);
    }

    public static function getAvailableSorts(): array
    {
        return [
            self::SORT_PUBLISHED_DESC,
            self::SORT_PUBLISHED_ASC,
            self::SORT_POPULARITY,
        ];
    }

    public static function getAvailableTypes(): array
    {
        return [
            self::TYPE_YANDEX_NEWS,
            self::TYPE_GOOGLE_NEWS,
            self::TYPE_MEDIASTACK,
        ];
    }

    public function getFrequencyHours(): int
    {
        return match ($this->type) {
            self::TYPE_GOOGLE_NEWS => self::GOOGLE_NEWS_FREQ_HOURS,
            self::TYPE_YANDEX_NEWS => self::YANDEX_NEWS_FREQ_HOURS,
            self::TYPE_MEDIASTACK => self::MEDIASTACK_FREQ_HOURS,
        };
    }

    public function getFeedProcessorJobInstance(): IProcessFeedJob
    {
        return match ($this->type) {
            self::TYPE_GOOGLE_NEWS => new ProcessGoogleNewsFeedJob($this),
            self::TYPE_YANDEX_NEWS => new ProcessYandexNewsFeedJob($this),
            self::TYPE_MEDIASTACK => new ProcessMediastackFeedJob($this),
        };
    }

    public function shouldEnqueueProcessing(): bool
    {
        return !$this->latest_processed_at || $this->latest_processed_at->diffInHours() >= $this->getFrequencyHours();
    }
}
