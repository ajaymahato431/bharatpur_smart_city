<?php

namespace App\Filament\Resources\OfficerActivityResource\Pages;

use App\Filament\Resources\OfficerActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewOfficerActivity extends ViewRecord
{
    protected static string $resource = OfficerActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
