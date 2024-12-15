<?php

namespace App\Filament\Resources\OfficerActivityResource\Pages;

use App\Filament\Resources\OfficerActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOfficerActivity extends EditRecord
{
    protected static string $resource = OfficerActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
