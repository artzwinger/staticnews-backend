<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ForeignTagMap
 *
 * @property int $id
 * @property string $foreign_tag
 * @property int $tag_id
 * @method static \Database\Factories\ForeignTagMapFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignTagMap newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignTagMap newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignTagMap query()
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignTagMap whereForeignTag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignTagMap whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignTagMap whereTagId($value)
 * @mixin \Eloquent
 */
class ForeignTagMap extends Model
{
    use HasFactory;

    public $timestamps = false;
}
