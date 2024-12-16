<?php

namespace App\Filament\User\Resources\BirthCertificateFormResource\Pages;

use App\Filament\User\Resources\BirthCertificateFormResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBirthCertificateForm extends EditRecord
{
    protected static string $resource = BirthCertificateFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
