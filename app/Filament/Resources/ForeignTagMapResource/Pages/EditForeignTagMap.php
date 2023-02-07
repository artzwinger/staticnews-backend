<?php

namespace App\Filament\Resources\ForeignTagMapResource\Pages;

use App\Filament\Resources\ForeignTagMapResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditForeignTagMap extends EditRecord
{
    protected static string $resource = ForeignTagMapResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
