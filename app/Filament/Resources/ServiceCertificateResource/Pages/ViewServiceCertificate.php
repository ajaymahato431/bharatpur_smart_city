<?php

namespace App\Filament\Resources\ServiceCertificateResource\Pages;

use App\Filament\Resources\ServiceCertificateResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewServiceCertificate extends ViewRecord
{
    protected static string $resource = ServiceCertificateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
