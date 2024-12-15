<?php

namespace App\Filament\Resources\VerificationDetailResource\Pages;

use App\Filament\Resources\VerificationDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVerificationDetail extends EditRecord
{
    protected static string $resource = VerificationDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
