<?php

namespace App\Filament\Resources\SourceFeedResource\Pages;

use App\Filament\Resources\SourceFeedResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSourceFeed extends EditRecord
{
    protected static string $resource = SourceFeedResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
