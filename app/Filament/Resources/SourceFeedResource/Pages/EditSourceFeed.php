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
            TextInput::make('url')
                ->required()
                ->unique(SourceFeed::class, 'url'),
            TextInput::make('latest_article_marker')->nullable(),
            Select::make('website_id')->options(Website::all()->pluck('url', 'id'))->required(),
        ];
    }
}
