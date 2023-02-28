<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SourceFeedResource\Pages;
use App\Models\SourceFeed;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class SourceFeedResource extends Resource
{
    protected static ?string $model = SourceFeed::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('website.url')->searchable(),
                Tables\Columns\TextColumn::make('type')->searchable(),
                Tables\Columns\TextColumn::make('url')->searchable(),
                Tables\Columns\TextColumn::make('latest_processed_at')->dateTime(),
                Tables\Columns\TextColumn::make('keywords')->searchable(),
                Tables\Columns\TextColumn::make('sources')->searchable(),
                Tables\Columns\TextColumn::make('languages')->searchable(),
                Tables\Columns\TextColumn::make('countries')->searchable(),
                Tables\Columns\TextColumn::make('sort')->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSourceFeeds::route('/'),
            'create' => Pages\CreateSourceFeed::route('/create'),
            'edit' => Pages\EditSourceFeed::route('/{record}/edit'),
        ];
    }
}
