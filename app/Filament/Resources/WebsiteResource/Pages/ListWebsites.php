<?php

namespace App\Filament\Resources\WebsiteResource\Pages;

use App\Filament\Resources\WebsiteResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWebsites extends ListRecords
{
    protected static string $resource = WebsiteResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
