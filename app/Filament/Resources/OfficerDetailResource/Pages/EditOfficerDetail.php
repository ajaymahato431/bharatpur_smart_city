<?php

namespace App\Filament\Resources\OfficerDetailResource\Pages;

use App\Filament\Resources\OfficerDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOfficerDetail extends EditRecord
{
    protected static string $resource = OfficerDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
