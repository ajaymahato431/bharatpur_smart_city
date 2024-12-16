<?php

namespace App\Filament\Resources\OfficerDetailResource\Pages;

use App\Filament\Resources\OfficerDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewOfficerDetail extends ViewRecord
{
    protected static string $resource = OfficerDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
