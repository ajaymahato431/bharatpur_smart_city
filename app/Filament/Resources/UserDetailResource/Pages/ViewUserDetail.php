<?php

namespace App\Filament\Resources\UserDetailResource\Pages;

use App\Filament\Resources\UserDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewUserDetail extends ViewRecord
{
    protected static string $resource = UserDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
