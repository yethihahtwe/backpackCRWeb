<?php

namespace App\Services;

use Filament\Forms\Components\Group;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Fieldset;

class PageSpecificFormComponents
{
    public static function malariaCaseForm(): array
    {
        return [
            Split::make([
                Section::make('Reporting Period')
                    ->schema([
                        FormComponents::rxMonth(),
                        FormComponents::rxYear(),
                        FormComponents::testDate(),
                    ])
                    ->icon(AppIcons::CALENDAR_ICON)
                    ->grow(false),
                Section::make('Patient Information')
                    ->schema([
                        Fieldset::make('Particulars')
                            ->schema([
                                FormComponents::name(),
                                FormComponents::age(),
                                FormComponents::sex(),
                                FormComponents::address(),
                            ])->columns(4),
                        Fieldset::make('Test Results')
                            ->schema([
                                FormComponents::rdtBool()
                                    ->columnSpan(2),
                                FormComponents::rdtPosResult()
                                    ->columnSpan(2),
                                FormComponents::symptom()
                                    ->columnSpan(2),
                            ])
                            ->columns(6),
                        Fieldset::make('Medications')
                            ->schema([
                                Group::make([
                                    FormComponents::medicationName('act24', 'ACT 24'),
                                    FormComponents::medicationAmount('act24_amount', 'ACT 24', 'act24'),
                                ])->columnSpanFull()->columns(2),

                                FormComponents::medicationName('act18', 'ACT 18'),
                                FormComponents::medicationAmount('act18_amount', 'ACT 18', 'act18'),
                            ]),
                    ])
                    ->icon(AppIcons::PATIENT_ICON)
                    ->columnSpanFull(),
            ])
                ->columnSpanFull(),
        ];
    }
}
