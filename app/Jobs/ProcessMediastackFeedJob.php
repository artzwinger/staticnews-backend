<?php

namespace App\Jobs;

use App\Models\SourceFeed;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessMediastackFeedJob implements ShouldQueue, IProcessFeedJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private SourceFeed $feed;

    public function __construct(SourceFeed $feed)
    {
        $this->feed = $feed;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
    }
}
