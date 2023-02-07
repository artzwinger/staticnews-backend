<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WebsiteResource\Pages;
use App\Filament\Resources\WebsiteResource\RelationManagers;
use App\Models\Website;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WebsiteResource extends Resource
{
    protected static ?string $model = Website::class;

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
            'index' => Pages\ListWebsites::route('/'),
            'create' => Pages\CreateWebsite::route('/create'),
            'view' => Pages\ViewWebsite::route('/{record}'),
            'edit' => Pages\EditWebsite::route('/{record}/edit'),
        ];
    }    
}
