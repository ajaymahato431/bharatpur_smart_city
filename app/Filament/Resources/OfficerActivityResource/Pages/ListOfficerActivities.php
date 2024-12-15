<?php

namespace App\Filament\Resources\OfficerActivityResource\Pages;

use App\Filament\Resources\OfficerActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOfficerActivities extends ListRecords
{
    protected static string $resource = OfficerActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
