<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * App\Models\ForeignTag
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @method static \Database\Factories\ForeignTagFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignTag query()
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignTag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignTag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignTag whereSlug($value)
 * @mixin \Eloquent
 */
class ForeignTag extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'slug',
    ];

    protected static function boot()
    {
        parent::boot();

        self::creating(function (ForeignTag $model) {
            $model->slug = $model->getSlugFromName();
        });

        self::updating(function (ForeignTag $model) {
            $model->slug = $model->getSlugFromName();
        });
    }

    public function getSlugFromName(): string
    {
        return Str::slug(Str::transliterate($this->name));
    }
}
