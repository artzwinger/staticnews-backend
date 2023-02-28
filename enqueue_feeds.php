<?php declare(strict_types=1);

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Artisan;

require __DIR__ . '/vendor/autoload.php';
/** @var Application $app */
$app = require __DIR__ . '/bootstrap/app.php';

/**
 * For Lumen, use:
 * $app->make(Laravel\Lumen\Console\Kernel::class);
 * $app->boot();
 */
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

return function ($event) {
    Artisan::call('enqueue_feeds_processing');
    return 0;
};
