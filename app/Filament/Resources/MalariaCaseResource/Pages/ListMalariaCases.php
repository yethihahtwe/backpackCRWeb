<?php

namespace App\Filament\Resources\MalariaCaseResource\Pages;

use App\Filament\Resources\MalariaCaseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

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
}
