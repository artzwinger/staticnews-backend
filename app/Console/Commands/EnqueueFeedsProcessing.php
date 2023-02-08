<?php

namespace App\Console\Commands;

use App\Models\SourceFeed;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as SymfonyCommand;

class EnqueueFeedsProcessing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'enqueue_feeds_processing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Look for feeds that needs to be processed and enqueue their processing';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $feeds = SourceFeed::query()->get();
        foreach ($feeds as $feed) {
            if ($feed->shouldEnqueueProcessing()) {
                dispatch($feed->getFeedProcessorJobInstance());
            }
        }
        return SymfonyCommand::SUCCESS;
    }
}
