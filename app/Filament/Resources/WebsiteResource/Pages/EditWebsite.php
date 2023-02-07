<?php

namespace App\Filament\Resources\WebsiteResource\Pages;

use App\Filament\Resources\WebsiteResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWebsite extends EditRecord
{
    protected static string $resource = WebsiteResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
