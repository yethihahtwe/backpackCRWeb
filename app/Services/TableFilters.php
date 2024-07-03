<?php

namespace App\Services;

use DateTime;
use Illuminate\Support\Carbon;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Date;

class TableFilters
{
    public static function malariaCaseTableFilters(): array
    {
        return [
            Filter::make('table-filter')
                ->form([
                    DatePicker::make('start_date')
                        ->label('Filter Start Date')
                        ->displayFormat('d-m-Y')
                        ->native(false)
                        ->icon(AppIcons::CALENDAR_ICON)
                        ->maxDate(now())
                        ->placeholder('Start Date')
                        ->closeOnDateSelection()
                        ->default(now()->subMonth()->startOfMonth()),
                    DatePicker::make('end_date')
                        ->label('Filter End Date')
                        ->displayFormat('d-m-Y')
                        ->native(false)
                        ->icon(AppIcons::CALENDAR_ICON)
                        ->maxDate(now())
                        ->placeholder('End Date')
                        ->closeOnDateSelection()
                        ->default(now()),
                    Checkbox::make('is_only_positive')
                        ->label('Show Only RDT Positive')
                        ->inline(false),
                    Select::make('area')
                        ->label('Backpack Area')
                        ->placeholder('Select Area')
                        ->options(
                            \App\Models\MalariaCase::select('area')->groupBy('area')->get()->mapWithKeys(function ($area) {
                                return [$area->area => $area->area];
                            })
                        )
                        ->native(false)
                        ->selectablePlaceholder(),
                ])
                ->columns(6)
                ->columnSpanFull()
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['start_date'] ?? null,
                            fn (Builder $query, $start_date) => $query->whereRaw('STR_TO_DATE(test_date, "%d-%m-%Y") >= ?', $start_date)
                        )
                        ->when(
                            $data['end_date']?? null,
                            fn (Builder $query, $end_date) => $query->whereRaw('STR_TO_DATE(test_date, "%d-%m-%Y") <=?', $end_date)
                        )
                        ->when(
                            $data['is_only_positive']?? null,
                            fn (Builder $query, $is_only_positive) => $query->where('rdt_bool', 'Positive')
                        )
                        ->when(
                            $data['area']?? null,
                            fn (Builder $query, $area) => $query->where('area', $area)
                        );
                })
        ];
    }
}
// ->query(function (Builder $query, array $data): Builder {
//     return $query
//         ->when(
//             $data['warehouse'] ?? null,
//             fn (Builder $query, $warehouseId) => $query->where('warehouse_id', $warehouseId)
//         )
//         ->when(
//             $data['category'] ?? null,
//             fn (Builder $query, $categoryId) => $query->where('category_id', $categoryId)
//         )
//         ->when(
//             $data['subcategory'] ?? null,
//             fn (Builder $query, $subcategoryId) => $query->where('subcategory_id', $subcategoryId)
//         );
// })
