<?php

namespace App\Filament\Resources\SourceFeedResource\Pages;

use App\Filament\Resources\SourceFeedResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSourceFeed extends ViewRecord
{
    protected static string $resource = SourceFeedResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
