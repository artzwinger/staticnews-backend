<?php

namespace App\Filament\Resources\SourceFeedResource\Pages;

use App\Filament\Resources\SourceFeedResource;
use App\Models\SourceFeed;
use App\Models\Website;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\CreateRecord;

class CreateSourceFeed extends CreateRecord
{
    protected static string $resource = SourceFeedResource::class;

    protected function getFormSchema(): array
    {
        return [
            Select::make('website_id')->options(Website::all()->pluck('url', 'id'))->required(),
            Select::make('type')->options([
                SourceFeed::TYPE_YANDEX_NEWS => 'Yandex news',
                SourceFeed::TYPE_GOOGLE_NEWS => 'Google news',
                SourceFeed::TYPE_MEDIASTACK => 'Mediastack',
            ])->required(),
            Section::make('Yandex / Google news settings')
                ->collapsible()
                ->schema([
                    TextInput::make('url')->nullable(),
                ]),
            Section::make('Mediastack settings')
                ->collapsible()
                ->collapsed()
                ->schema([
                    TextInput::make('keywords')->nullable(),
                    TextInput::make('sources')->nullable(),
                    TextInput::make('categories')->nullable(),
                    TextInput::make('countries')->nullable(),
                    TextInput::make('languages')->nullable(),
                    Select::make('sort')->options([
                        SourceFeed::SORT_PUBLISHED_DESC => 'Published DESC',
                        SourceFeed::SORT_PUBLISHED_ASC => 'Published ASC',
                        SourceFeed::SORT_POPULARITY => 'Popularity',
                    ]),
                ]),
            TextInput::make('latest_article_marker')->nullable(),
        ];
    }
}
