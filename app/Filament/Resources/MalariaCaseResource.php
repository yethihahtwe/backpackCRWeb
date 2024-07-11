<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Services\AppIcons;
use Filament\Tables\Table;
use App\Models\MalariaCase;
use App\Services\TableFilters;
use Filament\Resources\Resource;
use App\Services\TableComponents;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Actions\ExportAction;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Exports\MalariaCaseExporter;
use Filament\Actions\Exports\Enums\ExportFormat;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\MalariaCaseResource\Pages;
use App\Filament\Resources\MalariaCaseResource\RelationManagers;
use App\Services\PageSpecificFormComponents;

class MalariaCaseResource extends Resource
{
    protected static ?string $model = MalariaCase::class;

    protected static ?string $navigationIcon = AppIcons::CASE_ICON;

    protected static ?string $navigationLabel = 'Malaria Case Report';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(PageSpecificFormComponents::malariaCaseForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->deferLoading()
            ->defaultGroup('usr_name')
            ->striped()
            ->recordUrl(null)
            ->columns(TableComponents::malariaCaseTableComponents())
            ->defaultSort('DB_ID', 'desc')
            ->filters(
                TableFilters::malariaCaseTableFilters(),
                layout: FiltersLayout::AboveContent,
            )
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->headerActions([
                ExportAction::make()
                    ->icon(AppIcons::DOWNLOAD_ICON)
                    ->label('Download Excel')
                    ->color('gray')
                    ->exporter(MalariaCaseExporter::class)
                    ->fileName('malaria_export' . date('d-m-Y'))
                    ->formats([ExportFormat::Xlsx]),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
