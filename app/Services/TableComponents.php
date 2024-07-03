<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;

class TableComponents
{
    public static function malariaCaseTableComponents(): array
    {
        return [
            TextColumn::make('test_date')
                ->formatStateUsing(fn ($state) => Carbon::createFromFormat('d-m-Y', $state)->format('d-F-Y'))
                ->label('RDT Test Date')
                ->size(TextColumn\TextColumnSize::ExtraSmall)
                ->color(fn ($record) => CustomFunctions::getTableCellColor($record)),
            TextColumn::make('name')->formatStateUsing(fn ($state) => Str::title($state))
                ->size(TextColumn\TextColumnSize::ExtraSmall)
                ->color(fn ($record) => CustomFunctions::getTableCellColor($record)),
            TextColumn::make('age')->label('Age(yrs)')->alignEnd()
                ->size(TextColumn\TextColumnSize::ExtraSmall)
                ->color(fn ($record) => CustomFunctions::getTableCellColor($record)),
            TextColumn::make('sex')->badge()->formatStateUsing(fn ($state) => match ($state) {
                'Male' => 'M',
                'Female' => 'F',
            })
                ->size(TextColumn\TextColumnSize::ExtraSmall),
            IconColumn::make('pregnancy')
                ->label('Preg')
                ->icon(function ($record, $state) {
                    if ($record->sex === 'Female' && $state === 'true') {
                        return AppIcons::TICK_ICON;
                    }
                    return null;
                })
                ->color('warning'),
            TextColumn::make('address')->wrap()->formatStateUsing(fn ($state) => Str::title($state))
                ->size(TextColumn\TextColumnSize::ExtraSmall)
                ->color(fn ($record) => CustomFunctions::getTableCellColor($record)),
            TextColumn::make('rdt_bool')->label('RDT')->badge()
                ->formatStateUsing(fn ($state) => match ($state) {
                    'Positive' => 'Pos',
                    'Negative' => 'Neg',
                })
                ->color(fn ($state) => match ($state) {
                    'Positive' => 'danger',
                    'Negative' => 'success',
                })->size(TextColumn\TextColumnSize::ExtraSmall),
            TextColumn::make('rdt_pos_result')
                ->label('MP')
                ->badge()
                ->color('danger')
                ->formatStateUsing(fn ($state) => strtoupper($state)),
            TextColumn::make('symptom')
                ->label('Symptoms')
                ->size(TextColumn\TextColumnSize::ExtraSmall)
                ->color(fn ($record) => CustomFunctions::getTableCellColor($record)),
            IconColumn::make('act24')
                ->icon(fn ($state) => $state === 'true' ? AppIcons::TICK_ICON : null)
                ->color('success'),
            TextColumn::make('act24_amount')
                ->size(TextColumn\TextColumnSize::ExtraSmall)
                ->color('success'),
            IconColumn::make('act18')
                ->icon(fn ($state) => $state === 'true' ? AppIcons::TICK_ICON : null)
                ->color('success'),
            TextColumn::make('act18_amount')
                ->size(TextColumn\TextColumnSize::ExtraSmall)
                ->color('success'),
            IconColumn::make('act12')
                ->icon(fn ($state) => $state === 'true' ? AppIcons::TICK_ICON : null)
                ->color('success'),
            TextColumn::make('act12_amount')
                ->size(TextColumn\TextColumnSize::ExtraSmall)
                ->color('success'),
            IconColumn::make('act6')
                ->icon(fn ($state) => $state === 'true' ? AppIcons::TICK_ICON : null)
                ->color('success'),
            TextColumn::make('act6_amount')
                ->size(TextColumn\TextColumnSize::ExtraSmall)
                ->color('success'),
            IconColumn::make('chloroquine')
                ->label('CQ')
                ->icon(fn ($state) => $state === 'true' ? AppIcons::TICK_ICON : null)
                ->color('success'),
            TextColumn::make('chloroquine_amount')
                ->label('CQ Amount')
                ->size(TextColumn\TextColumnSize::ExtraSmall)
                ->color('success'),
            IconColumn::make('primaquine')
                ->label('PQ')
                ->icon(fn ($state) => $state === 'true' ? AppIcons::TICK_ICON : null)
                ->color('success'),
            TextColumn::make('primaquine_amount')
                ->size(TextColumn\TextColumnSize::ExtraSmall)
                ->color('success'),
            TextColumn::make('refer'),
            TextColumn::make('death'),
            TextColumn::make('receive_rx'),
            TextColumn::make('travel'),
            TextColumn::make('job'),
            TextColumn::make('other_job'),
            TextColumn::make('remark'),
            TextColumn::make('vol_name'),
            TextColumn::make('state'),
            TextColumn::make('tsp_mimu'),
            TextColumn::make('tsp_eho'),
            TextColumn::make('area'),
            TextColumn::make('vil'),
            TextColumn::make('usr_name'),
            TextColumn::make('usr_id'),

        ];
    }
}
// 'rx_month',
//         '',
//         'test_date',
//         'name',
//         'age',
//         'address',
//         'sex',
//         'pregnancy',
//         'rdt_bool',
//         'rdt_pos_result',
//         'symptom',
//         'act24',
//         'act24_amount',
//         'act18',
//         'act18_amount',
//         'act12',
//         'act12_amount',
//         'act6',
//         'act6_amount',
//         'chloroquine',
//         'chloroquine_amount',
//         'primaquine',
//         'primaquine_amount',
//         'refer',
//         'death',
//         'receive_rx',
//         'travel',
//         'job',
//         'other_job',
//         'remark',
//         'vol_name',
//         'state',
//         'tsp_mimu',
//         'tsp_eho',
//         'area',
//         'vil',
//         'usr_name',
//         'usr_id',
