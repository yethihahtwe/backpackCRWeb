<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MalariaCaseResource\Pages;
use App\Filament\Resources\MalariaCaseResource\RelationManagers;
use App\Models\MalariaCase;
use App\Services\AppIcons;
use App\Services\TableComponents;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MalariaCaseResource extends Resource
{
    protected static ?string $model = MalariaCase::class;

    protected static ?string $navigationIcon = AppIcons::CASE_ICON;

    protected static ?string $navigationLabel = 'Malaria Case Report';

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
            ->columns(TableComponents::malariaCaseTableComponents())
            ->defaultSort('DB_ID', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListMalariaCases::route('/'),
            'create' => Pages\CreateMalariaCase::route('/create'),
            'edit' => Pages\EditMalariaCase::route('/{record}/edit'),
        ];
    }
}
