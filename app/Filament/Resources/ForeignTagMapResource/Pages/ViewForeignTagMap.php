<?php

namespace App\Filament\Resources\ForeignTagMapResource\Pages;

use App\Filament\Resources\ForeignTagMapResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewForeignTagMap extends ViewRecord
{
    protected static string $resource = ForeignTagMapResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
