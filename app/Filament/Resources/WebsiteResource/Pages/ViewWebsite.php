<?php

namespace App\Filament\Resources\WebsiteResource\Pages;

use App\Filament\Resources\WebsiteResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewWebsite extends ViewRecord
{
    protected static string $resource = WebsiteResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
