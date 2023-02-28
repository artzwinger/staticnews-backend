<?php

namespace App\Jobs;

use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class DownloadImageForArticle implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Article $article;
    private string $imageSrc;

    /**
     * @return void
     */
    public function __construct(Article $article, string $imageSrc)
    {
        $this->article = $article;
        $this->imageSrc = $imageSrc;
    }

    /**
     * @return void
     */
    public function handle(): void
    {
        $filename = $this->downloadImage($this->imageSrc);
        $this->article->update(['image_filename' => $filename, 'updated' => true]);
    }

    private function downloadImage($imageSrc): string
    {
        $filename = md5($imageSrc) . '.' . $this->getImageExt($imageSrc);
        if (!Storage::disk('s3')->exists($filename)) {
            $image = file_get_contents($imageSrc);
            Storage::disk('s3')->put($filename, $image);
        }
        return $filename;
    }

    private function getImageExt($imageSrc): string
    {
        $parts = explode('.', $imageSrc);
        return end($parts);
    }
}
