<?php

namespace App\Filament\Resources\MalariaCaseResource\Pages;

use Filament\Actions;
use Filament\Support\Enums\MaxWidth;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\MalariaCaseResource;

class ListMalariaCases extends ListRecords
{
    protected static string $resource = MalariaCaseResource::class;

    protected ?string $heading = 'Malaria Case Report';

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }

    public function getMaxContentWidth(): MaxWidth
    {
        return MaxWidth::Full;
    }
}
