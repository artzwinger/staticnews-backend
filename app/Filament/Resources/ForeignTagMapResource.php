<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ForeignTagMapResource\Pages;
use App\Models\ForeignTagMap;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class ForeignTagMapResource extends Resource
{
    protected static ?string $model = ForeignTagMap::class;

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
                Tables\Columns\TextColumn::make('foreignTag.name')
                    ->label('Foreign tag name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tag.name')
                    ->label('Tag name')
                    ->searchable(),
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
            'index' => Pages\ListForeignTagMaps::route('/'),
            'create' => Pages\CreateForeignTagMap::route('/create'),
            'edit' => Pages\EditForeignTagMap::route('/{record}/edit'),
        ];
    }
}
