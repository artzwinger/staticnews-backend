<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Website
 *
 * @property int $id
 * @property string $url
 * @property string $code
 * @method static \Database\Factories\WebsiteFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Website newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Website newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Website query()
 * @method static \Illuminate\Database\Eloquent\Builder|Website whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Website whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Website whereUrl($value)
 * @mixin \Eloquent
 */
class Website extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'code',
        'url',
    ];
}
