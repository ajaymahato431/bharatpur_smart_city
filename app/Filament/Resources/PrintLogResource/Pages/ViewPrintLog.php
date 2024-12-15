<?php

namespace App\Filament\Resources\PrintLogResource\Pages;

use App\Filament\Resources\PrintLogResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPrintLog extends ViewRecord
{
    protected static string $resource = PrintLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
