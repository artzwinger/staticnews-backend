<?php

namespace App\Filament\Resources\ForeignTagMapResource\Pages;

use App\Filament\Resources\ForeignTagMapResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListForeignTagMaps extends ListRecords
{
    protected static string $resource = ForeignTagMapResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
