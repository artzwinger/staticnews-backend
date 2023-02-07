<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\SourceFeed
 *
 * @property int $id
 * @property int $website_id
 * @property string $url
 * @property string $latest_article_marker
 * @property-read \App\Models\Website $website
 * @method static \Database\Factories\SourceFeedFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|SourceFeed newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SourceFeed newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SourceFeed query()
 * @method static \Illuminate\Database\Eloquent\Builder|SourceFeed whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SourceFeed whereLatestArticleMarker($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SourceFeed whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SourceFeed whereWebsiteId($value)
 * @mixin \Eloquent
 */
class SourceFeed extends Model
{
    use HasFactory;

    // how many articles to receive if there is no marker of the latest article saved
    const NO_MARKER_ARTICLES_FETCH_COUNT = 10;

    public function website(): BelongsTo
    {
        return $this->belongsTo(Website::class);
    }
}
