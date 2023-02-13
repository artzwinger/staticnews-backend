<?php

namespace App\Models;

use App\Trait\Scope\ArticleScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

/**
 * App\Models\Article
 *
 * @property int $id
 * @property int $website_id
 * @property int|null $source_feed_id
 * @property string $slug
 * @property string $title
 * @property string $description
 * @property string $content
 * @property string|null $image_filename
 * @property array|null $foreign_tags
 * @property int $updated
 * @property \Illuminate\Support\Carbon|null $foreign_created_at
 * @property \Illuminate\Support\Carbon|null $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tag> $tags
 * @property-read int|null $tags_count
 * @property-read \App\Models\Website $website
 * @method static \Database\Factories\ArticleFactory factory($count = null, $state = [])
 * @method static Builder|Article newModelQuery()
 * @method static Builder|Article newQuery()
 * @method static Builder|Article query()
 * @method static Builder|Article toPublish()
 * @method static Builder|Article whereContent($value)
 * @method static Builder|Article whereCreatedAt($value)
 * @method static Builder|Article whereDescription($value)
 * @method static Builder|Article whereForeignCreatedAt($value)
 * @method static Builder|Article whereForeignTags($value)
 * @method static Builder|Article whereId($value)
 * @method static Builder|Article whereImageFilename($value)
 * @method static Builder|Article wherePublishedAt($value)
 * @method static Builder|Article whereSlug($value)
 * @method static Builder|Article whereSourceFeedId($value)
 * @method static Builder|Article whereTitle($value)
 * @method static Builder|Article whereUpdated($value)
 * @method static Builder|Article whereWebsiteId($value)
 * @mixin \Eloquent
 */
class Article extends Model
{
    use HasFactory;
    use ArticleScope;

    const UPDATED_AT = null;

    protected $casts = [
        'foreign_tags' => 'array',
    ];

    protected $fillable = [
        'website_id',
        'source_feed_id',
        'slug',
        'title',
        'description',
        'content',
        'image_filename',
        'foreign_tags',
        'updated',
    ];

    protected $dates = [
        'foreign_created_at',
        'published_at',
    ];

    protected $appends = [
        'image_url',
    ];

    public function getImageUrlAttribute(): ?string
    {
        return $this->image_filename ? env('APP_URL') . Storage::url($this->image_filename) : null;
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function website(): BelongsTo
    {
        return $this->belongsTo(Website::class);
    }
}
