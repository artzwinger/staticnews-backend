<?php

namespace App\Trait\Scope;

use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;

/**
 * @method Builder|Article toPublish()
 */
trait ArticleScope
{
    public function scopeToPublish(Builder $query): Builder
    {
        return $query->whereNull('published_at')->orWhere('updated', '=', '1');
    }
}
