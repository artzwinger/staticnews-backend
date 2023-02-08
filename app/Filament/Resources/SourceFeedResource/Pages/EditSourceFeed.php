<?php

namespace App\Filament\Resources\SourceFeedResource\Pages;

use App\Filament\Resources\SourceFeedResource;
use App\Models\SourceFeed;
use App\Models\Website;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSourceFeed extends EditRecord
{
    protected static string $resource = SourceFeedResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('keywords')->nullable(),
            TextInput::make('sources')->nullable(),
            TextInput::make('categories')->nullable(),
            TextInput::make('countries')->nullable(),
            TextInput::make('languages')->nullable(),
            TextInput::make('latest_article_marker')->nullable(),
            Select::make('sort')->options([
                SourceFeed::SORT_PUBLISHED_DESC => 'Published DESC',
                SourceFeed::SORT_PUBLISHED_ASC => 'Published ASC',
                SourceFeed::SORT_POPULARITY => 'Popularity',
            ])->required(),
            Select::make('website_id')->options(Website::all()->pluck('url', 'id'))->required(),
        ];
    }
}
