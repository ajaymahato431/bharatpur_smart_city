<?php

namespace App\Filament\User\Resources\BirthCertificateFormResource\Pages;

use App\Filament\User\Resources\BirthCertificateFormResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBirthCertificateForms extends ListRecords
{
    protected static string $resource = BirthCertificateFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
