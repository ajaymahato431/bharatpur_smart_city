<?php

namespace App\Filament\Resources\VerificationDetailResource\Pages;

use App\Filament\Resources\VerificationDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewVerificationDetail extends ViewRecord
{
    protected static string $resource = VerificationDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
