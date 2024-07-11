<?php

namespace App\Filament\Resources\MalariaCaseResource\Pages;

use App\Filament\Resources\MalariaCaseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMalariaCase extends EditRecord
{
    protected static string $resource = MalariaCaseResource::class;

    protected static ?string $title = 'Edit Malaria Case Report';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
