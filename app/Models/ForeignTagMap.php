<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\ForeignTagMap
 *
 * @property int $id
 * @property int $website_id
 * @property int $foreign_tag_id
 * @property int $tag_id
 * @property-read \App\Models\Website $website
 * @method static \Database\Factories\ForeignTagMapFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignTagMap newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignTagMap newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignTagMap query()
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignTagMap whereForeignTagId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignTagMap whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignTagMap whereTagId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignTagMap whereWebsiteId($value)
 * @mixin \Eloquent
 */
class ForeignTagMap extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function website(): BelongsTo
    {
        return $this->belongsTo(Website::class);
    }
}
