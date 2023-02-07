<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Article
 *
 * @property int $id
 * @property int $website_id
 * @property int|null $source_feed_id
 * @property string $title
 * @property string $description
 * @property string $content
 * @property string|null $image_filename
 * @property array|null $foreign_tags
 * @property string|null $foreign_created_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tag> $tags
 * @property-read int|null $tags_count
 * @property-read \App\Models\Website $website
 * @method static \Database\Factories\ArticleFactory factory($count = null, $state = [])
 * @method static Builder|Article newModelQuery()
 * @method static Builder|Article newQuery()
 * @method static Builder|Article query()
 * @method static Builder|Article whereContent($value)
 * @method static Builder|Article whereCreatedAt($value)
 * @method static Builder|Article whereDescription($value)
 * @method static Builder|Article whereForeignCreatedAt($value)
 * @method static Builder|Article whereForeignTags($value)
 * @method static Builder|Article whereId($value)
 * @method static Builder|Article whereImageFilename($value)
 * @method static Builder|Article whereSourceFeedId($value)
 * @method static Builder|Article whereTitle($value)
 * @method static Builder|Article whereWebsiteId($value)
 * @mixin \Eloquent
 */
class Article extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    protected $casts = [
        'foreign_tags' => 'array',
    ];

    protected $fillable = [
        'website_id',
        'source_feed_id',
        'title',
        'description',
        'content',
        'image_filename',
        'foreign_tags',
        'foreign_created_at',
    ];

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function website(): BelongsTo
    {
        return $this->belongsTo(Website::class);
    }
}
