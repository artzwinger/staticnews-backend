<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Resources\ArticleResource;
use App\Models\Article;
use App\Models\ForeignTag;
use App\Models\Website;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditArticle extends EditRecord
{
    protected static string $resource = ArticleResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $article = Article::whereId($data['id'])->first();
        if ($article->published_at) {
            $data['updated'] = true;
        }
        unset($data['id']);
        return $data;
    }

    protected function getFormSchema(): array
    {
        return [
            Hidden::make('id'),
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
