<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\FeedItem
 *
 * @property int $id
 * @property int|null $article_id
 * @property string $author
 * @property string $title
 * @property string $description
 * @property string $url
 * @property string $image
 * @property string $category
 * @property string $source
 * @property string $language
 * @property string $country
 * @property string $source_published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\FeedItemFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|FeedItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FeedItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FeedItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|FeedItem whereArticleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FeedItem whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FeedItem whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FeedItem whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FeedItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FeedItem whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FeedItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FeedItem whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FeedItem whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FeedItem whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FeedItem whereSourcePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FeedItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FeedItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FeedItem whereUrl($value)
 * @mixin \Eloquent
 */
class FeedItem extends Model
{
    use HasFactory;
}
