<?php

namespace App\Services;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;

class FormComponents
{
    public static function rxMonth(): Select
    {
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        return Select::make('rx_month')
            ->label('Month of Treatment')
            ->placeholder('Select Month')
            ->options($months)
            ->required()
            ->native(false);
    }

    public static function rxYear(): Select
    {
        $years = range(2023, date('Y') - 1);
        return Select::make('rx_year')
            ->label('Year of Treatment')
            ->placeholder('Select Year')
            ->options($years)
            ->required()
            ->native(false);
    }

    public static function testDate(): DatePicker
    {
        return DatePicker::make('test_date')
            ->label('RDT Date')
            ->placeholder('Select Test Date')
            ->format('d-m-Y')
            ->displayFormat('d-M-Y')
            ->required()
            ->native(false)
            ->closeOnDateSelection();
    }

    public static function name(): TextInput
    {
        return TextInput::make('name')
            ->label('Name')
            ->required()
            ->placeholder('Enter Name')
            ->maxLength(100);
    }

    public static function age(): TextInput
    {
        return TextInput::make('age')
            ->label('Age')
            ->required()
            ->numeric()
            ->step(1)
            ->minValue(0)
            ->placeholder('Enter Age')
            ->maxLength(3)
            ->suffix('yr(s)');
    }

    public static function address(): TextInput
    {
        return TextInput::make('address')
            ->label('Address')
            ->required()
            ->placeholder('Enter Address')
            ->maxLength(255);
    }

    public static function sex()
    {
        return Group::make([
            Radio::make('sex')
                ->label('Sex')
                ->options([
                    'Male' => 'Male',
                    'Female' => 'Female',
                ])
                ->required()
                ->inline()
                ->inlineLabel(false)
                ->live(),
            Radio::make('pregnancy')
                ->label('Pregnancy')
                ->options([
                    'true' => 'Yes',
                    'false' => 'No',
                ])
                ->required()
                ->inline()
                ->inlineLabel(false)
                ->visible(fn (Get $get): bool => $get('sex') === 'Female')
        ]);
    }

    public static function rdtBool(): Radio
    {
        return Radio::make('rdt_bool')
            ->label('RDT Result')
            ->options([
                'Positive' => 'Positive',
                'Negative' => 'Negative',
            ])
            ->required()
            ->inline()
            ->inlineLabel(false)
            ->live()
            ->afterStateUpdated(function (Set $set) {
                $set('rdt_pos_result', null);
                $set('symptom', null);
            });
    }

    public static function rdtPosResult(): Radio
    {
        return Radio::make('rdt_pos_result')
            ->label('Positive M.P')
            ->options([
                'pf' => 'P.Falciparum',
                'pv' => 'P.Vivax',
                'mixed' => 'Mixed',
            ])
            ->required()
            ->inline()
            ->inlineLabel(false)
            ->visible(fn (Get $get): bool => $get('rdt_bool') === 'Positive')
            ->live();
    }

    public static function symptom(): Radio
    {
        return Radio::make('symptom')
            ->label('Symptoms')
            ->options([
                'Moderate' => 'Moderate',
                'Severe' => 'Severe',
            ])
            ->required()
            ->inline()
            ->inlineLabel(false)
            ->visible(fn (Get $get): bool => $get('rdt_bool') === 'Positive');
    }

    public static function medicationName($id, $label): Checkbox
    {
        return Checkbox::make($id)
            ->label($label)
            ->inline()
            ->inlineLabel(false)
            ->live()
            ->afterStateUpdated(fn (Set $set) => $set($id . '_amount', null));
    }

    public static function medicationAmount($id, $label, $medicationName): TextInput
    {
        return TextInput::make($id)
            ->label($label . ' Amount')
            ->required()
            ->numeric()
            ->step(1)
            ->minValue(0)
            ->placeholder('Enter Amount')
            ->inlineLabel(true)
            ->visible(fn (Get $get): bool => $get($medicationName) == true);
    }
}

// 'rx_month',
//         'rx_year',
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
