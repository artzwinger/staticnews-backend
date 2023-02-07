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
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'view' => Pages\ViewSourceFeed::route('/{record}'),
            'edit' => Pages\EditSourceFeed::route('/{record}/edit'),
        ];
    }
}
