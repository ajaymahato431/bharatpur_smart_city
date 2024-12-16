<?php

namespace App\Filament\Resources\OfficerDetailResource\Pages;

use App\Filament\Resources\OfficerDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOfficerDetails extends ListRecords
{
    protected static string $resource = OfficerDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
