<?php

namespace App\Filament\Resources\ForeignTagMapResource\Pages;

use App\Filament\Resources\ForeignTagMapResource;
use App\Models\ForeignTag;
use App\Models\SourceFeed;
use App\Models\Tag;
use App\Models\Website;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateForeignTagMap extends CreateRecord
{
    protected static string $resource = ForeignTagMapResource::class;

    protected function getFormSchema(): array
    {
        return [
            Select::make('website_id')
                ->options(Website::all()->pluck('url', 'id'))->required(),
            Select::make('foreign_tag_id')
                ->options(ForeignTag::all()->pluck('name', 'id'))->required(),
            Select::make('source_feed_id')
                ->options(SourceFeed::all()->pluck('url', 'id'))->required(),
            Select::make('tag_id')
                ->options(Tag::all()->pluck('name', 'id'))->required(),
        ];
    }
}
