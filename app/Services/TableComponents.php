<?php

namespace App\Services;

use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Illuminate\Contracts\Support\Htmlable;

class TableComponents
{
    public static function malariaCaseTableComponents(): array
    {
        return [
            TextColumn::make('test_date')
                // ->formatStateUsing(fn ($state) => Carbon::createFromFormat('d-m-Y', $state)->format('d-F-Y'))
                ->label('Test Date')
                ->size(TextColumn\TextColumnSize::ExtraSmall)
                ->color(fn ($record) => CustomFunctions::getTableCellColor($record)),
            TextColumn::make('name')->formatStateUsing(fn ($state) => Str::title($state))
                ->size(TextColumn\TextColumnSize::ExtraSmall)
                ->color(fn ($record) => CustomFunctions::getTableCellColor($record)),
            TextColumn::make('age')->alignEnd()
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
                    } else if ($record->sex === 'Female' && $state === 'false') {
                        return AppIcons::CROSS_ICON;
                    }
                    return null;
                })
                ->color('warning'),
            TextColumn::make('address')->wrap()->formatStateUsing(fn ($state) => Str::title($state))
                ->size(TextColumn\TextColumnSize::ExtraSmall)
                ->color(fn ($record) => CustomFunctions::getTableCellColor($record)),
            IconColumn::make('rdt_bool')->label('RDT')
                ->icon(fn ($state) => match ($state) {
                    'Positive' => AppIcons::POSITIVE_ICON,
                    'Negative' => AppIcons::NEGATIVE_ICON,
                })
                ->color(fn ($state) => match ($state) {
                    'Positive' => 'danger',
                    'Negative' => 'success',
                }),
            TextColumn::make('rdt_pos_result')
                ->label('MP')
                ->badge()
                ->color('danger')
                ->formatStateUsing(fn ($state) => strtoupper($state)),
            TextColumn::make('symptom')
                ->label('Symptoms')
                ->size(TextColumn\TextColumnSize::ExtraSmall)
                ->color(fn ($record) => CustomFunctions::getTableCellColor($record)),
            TextColumn::make('act24_amount')
            ->label('ACT24')
            ->icon(AppIcons::TICK_ICON)
                ->size(TextColumn\TextColumnSize::ExtraSmall)
                ->color('success'),
            TextColumn::make('act18_amount')
            ->label('ACT18')
            ->icon(AppIcons::TICK_ICON)
                ->size(TextColumn\TextColumnSize::ExtraSmall)
                ->color('success'),
            TextColumn::make('act12_amount')
            ->label('ACT12')
            ->icon(AppIcons::TICK_ICON)
                ->size(TextColumn\TextColumnSize::ExtraSmall)
                ->color('success'),
            TextColumn::make('act6_amount')
            ->label('ACT6')
            ->icon(AppIcons::TICK_ICON)
                ->size(TextColumn\TextColumnSize::ExtraSmall)
                ->color('success'),
            TextColumn::make('chloroquine_amount')
                ->label('CQ')
                ->icon(AppIcons::TICK_ICON)
                ->size(TextColumn\TextColumnSize::ExtraSmall)
                ->color('success'),
            TextColumn::make('primaquine_amount')
            ->label('PQ')
            ->icon(AppIcons::TICK_ICON)
                ->size(TextColumn\TextColumnSize::ExtraSmall)
                ->color('success'),
            IconColumn::make('refer')
            ->icon(fn($state) => $state === 'true'? AppIcons::TICK_ICON : null)
            ->color('warning'),
            IconColumn::make('death')
            ->icon(fn($state) => $state === 'true'? AppIcons::TICK_ICON : null)
            ->color('danger'),

            TextColumn::make('receive_rx')
            ->label('Rx')
            ->formatStateUsing(fn($state) => match ($state) {
                'Within-24hr' => 'w/t:24h',
                'After-24hr' => 'a/f:24h',
            })
            ->color(fn ($record) => CustomFunctions::getTableCellColor($record))
            ->size(TextColumn\TextColumnSize::ExtraSmall),
            IconColumn::make('travel')
            ->icon(fn($state) => $state === 'true'? AppIcons::TICK_ICON : null)
            ->color(fn($record) => CustomFunctions::getTableCellColor($record)),
            TextColumn::make('job')
            ->formatStateUsing(fn($state, $record) => new HtmlString($state . '<br /><i>'. $record->other_job ?? '' . '</i>'))
            ->size(TextColumn\TextColumnSize::ExtraSmall)
            ->color(fn ($record) => CustomFunctions::getTableCellColor($record)),
            TextColumn::make('remark')
            ->wrap()
            ->size(TextColumn\TextColumnSize::ExtraSmall)
            ->color(fn ($record) => CustomFunctions::getTableCellColor($record)),
            TextColumn::make('vol_name')
            ->label(new HtmlString('Volunteer<br />Name'))
            ->formatStateUsing(fn($state) => Str::title($state))
            ->size(TextColumn\TextColumnSize::ExtraSmall)
            ->color(fn ($record) => CustomFunctions::getTableCellColor($record)),
            TextColumn::make('state')
            ->label('Township')
            ->formatStateUsing(fn($record) => new HtmlString($record->tsp_mimu . '/' . $record->tsp_eho . '<br />' . $record->state))
            ->size(TextColumn\TextColumnSize::ExtraSmall)
            ->color(fn ($record) => CustomFunctions::getTableCellColor($record)),
            TextColumn::make('vil')
            ->label(new HtmlString('Village/' . '<br />Area'))
            ->formatStateUsing(fn($record) => new HtmlString($record->vil . '<br />' . $record->area))
            ->size(TextColumn\TextColumnSize::ExtraSmall)
            ->color(fn ($record) => CustomFunctions::getTableCellColor($record)),
            // TextColumn::make('usr_name')
            // ->label('Username')
            // ->size(TextColumn\TextColumnSize::ExtraSmall)
            // ->color(fn ($record) => CustomFunctions::getTableCellColor($record)),

        ];
    }
}
