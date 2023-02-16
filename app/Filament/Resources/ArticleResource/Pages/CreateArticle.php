<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Resources\ArticleResource;
use App\Models\Website;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\CreateRecord;

class CreateArticle extends CreateRecord
{
    protected static string $resource = ArticleResource::class;

    protected function getFormSchema(): array
    {
        return [
            FileUpload::make('image_filename')->image(),
            TextInput::make('title')
                ->required(),
            Textarea::make('description')->required(),
            RichEditor::make('content')->required(),
            Select::make('website_id')->options(Website::all()->pluck('url', 'id'))->required(),
            Select::make('foreignTags')
                ->searchable()
                ->multiple()->preload()
                ->relationship('foreignTags', 'name'),
        ];
    }
}
