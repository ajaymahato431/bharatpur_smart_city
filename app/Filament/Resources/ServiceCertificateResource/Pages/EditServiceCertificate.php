<?php

namespace App\Filament\Resources\ServiceCertificateResource\Pages;

use App\Filament\Resources\ServiceCertificateResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditServiceCertificate extends EditRecord
{
    protected static string $resource = ServiceCertificateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
