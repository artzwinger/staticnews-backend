<?php

namespace App\Filament\Resources\SourceFeedResource\Pages;

use App\Filament\Resources\SourceFeedResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSourceFeeds extends ListRecords
{
    protected static string $resource = SourceFeedResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
