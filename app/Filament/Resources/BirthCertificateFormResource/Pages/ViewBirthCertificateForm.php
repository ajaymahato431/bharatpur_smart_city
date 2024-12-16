<?php

namespace App\Filament\Resources\BirthCertificateFormResource\Pages;

use App\Filament\Resources\BirthCertificateFormResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Database\Eloquent\Model;

class ViewBirthCertificateForm extends ViewRecord
{
    protected static string $resource = BirthCertificateFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\EditAction::make(),
            Actions\Action::make('mark_verified')
                ->label('Verify')
                ->visible(fn (Model $record) => $record->serviceRequests->last()?->status === 'pending')
                ->action(function (Model $record) {
                    $serviceRequest = $record->serviceRequests->last();
                    if ($serviceRequest) {
                        $serviceRequest->update(['status' => 'verified']);
                    }
                })
                ->color('primary')
                ->icon('heroicon-o-check-circle')
                ->requiresConfirmation(),

            Actions\Action::make('approve')
                ->label('Approve')
                ->visible(fn (Model $record) => $record->serviceRequests->last()?->status === 'verified')
                ->action(function (Model $record) {
                    $serviceRequest = $record->serviceRequests->last();
                    if ($serviceRequest) {
                        $serviceRequest->update(['status' => 'approved']);
                    }
                })
                ->color('success')
                ->icon('heroicon-o-check')
                ->requiresConfirmation(),

            Actions\Action::make('reject')
                ->label('Reject')
                ->visible(fn (Model $record) => $record->serviceRequests->last()?->status !== 'approved')
                ->action(function (Model $record) {
                    $serviceRequest = $record->serviceRequests->last();
                    if ($serviceRequest) {
                        $serviceRequest->update(['status' => 'rejected']);
                    }
                })
                ->color('danger')
                ->icon('heroicon-o-x-circle')
                ->requiresConfirmation(),
        ];
    }
}
