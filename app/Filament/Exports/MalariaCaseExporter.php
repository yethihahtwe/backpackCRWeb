<?php

namespace App\Filament\Exports;

use App\Models\MalariaCase;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class MalariaCaseExporter extends Exporter
{
    protected static ?string $model = MalariaCase::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('rx_month'),
            ExportColumn::make('rx_year'),
            ExportColumn::make('test_date'),
            ExportColumn::make('name'),
            ExportColumn::make('age'),
            ExportColumn::make('address'),
            ExportColumn::make('sex'),
            ExportColumn::make('pregnancy'),
            ExportColumn::make('rdt_bool'),
            ExportColumn::make('rdt_pos_result'),
            ExportColumn::make('symptom'),
            ExportColumn::make('act24'),
            ExportColumn::make('act24_amount'),
            ExportColumn::make('act18'),
            ExportColumn::make('act18_amount'),
            ExportColumn::make('act12'),
            ExportColumn::make('act12_amount'),
            ExportColumn::make('act6'),
            ExportColumn::make('act6_amount'),
            ExportColumn::make('chloroquine'),
            ExportColumn::make('chloroquine_amount'),
            ExportColumn::make('primaquine'),
            ExportColumn::make('primaquine_amount'),
            ExportColumn::make('refer'),
            ExportColumn::make('death'),
            ExportColumn::make('receive_rx'),
            ExportColumn::make('travel'),
            ExportColumn::make('job'),
            ExportColumn::make('other_job'),
            ExportColumn::make('remark'),
            ExportColumn::make('vol_name'),
            ExportColumn::make('state'),
            ExportColumn::make('tsp_mimu'),
            ExportColumn::make('tsp_eho'),
            ExportColumn::make('area'),
            ExportColumn::make('vil'),
            ExportColumn::make('usr_name'),
            ExportColumn::make('usr_id'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your malaria case export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
