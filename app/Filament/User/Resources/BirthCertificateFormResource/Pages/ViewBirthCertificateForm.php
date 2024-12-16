<?php

namespace App\Filament\User\Resources\BirthCertificateFormResource\Pages;

use App\Filament\User\Resources\BirthCertificateFormResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBirthCertificateForm extends ViewRecord
{
    protected static string $resource = BirthCertificateFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
