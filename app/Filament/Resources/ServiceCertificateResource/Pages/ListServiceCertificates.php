<?php

namespace App\Filament\Resources\ServiceCertificateResource\Pages;

use App\Filament\Resources\ServiceCertificateResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListServiceCertificates extends ListRecords
{
    protected static string $resource = ServiceCertificateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
