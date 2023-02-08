<?php

namespace App\Jobs;

use App\Models\SourceFeed;

interface IProcessFeedJob
{
    public function __construct(SourceFeed $feed);
}
