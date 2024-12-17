<?php

namespace App\Filament\Resources\BirthCertificateFormResource\Pages;

use App\Filament\Resources\BirthCertificateFormResource;
use App\Models\VerificationDetail;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ViewBirthCertificateForm extends ViewRecord
{
    protected static string $resource = BirthCertificateFormResource::class;


    protected function getHeaderActions(): array
    {
        return [
            // Actions\EditAction::make(),
            Action::make('mark_verified')
                ->label('Verify')
                ->visible(fn(Model $record) => $record->serviceRequests->last()?->status === 'pending')
                ->action(function (Model $record, array $data) {
                    $serviceRequest = $record->serviceRequests->last();

                    if ($serviceRequest) {
                        // Create a new VerificationDetail record
                        VerificationDetail::create([
                            'service_request_id' => $serviceRequest->id,
                            'officer_id' => Auth::id(), // Assuming the logged-in user is the officer
                            'form_no' => $data['form_no'],
                            'family_cost_no' => $data['family_cost_no'],
                            'municipality' => $data['municipality'],
                            'ward' => $data['ward'],
                        ]);

                        // Update the service request status to "verified"
                        $serviceRequest->update([
                            'status' => 'verified',
                            'verification_date' => now(),
                        ]);
                    }
                })
                ->form([
                    TextInput::make('form_no')
                        ->label('Form Number')
                        ->unique('verification_details', 'form_no')
                        ->required(),

                    DatePicker::make('form_date')
                        ->label('Form Date')
                        ->default(now())
                        ->required()
                        ->disabled(),

                    TextInput::make('family_cost_no')
                        ->label('Family Cost Number')
                        ->required(),

                    TextInput::make('municipality')
                        ->label('Municipality')
                        ->default('Bharatpur')
                        ->required(),

                    TextInput::make('ward')
                        ->label('Ward')
                        ->default(10)
                        ->required(),
                ])
                ->color('primary')
                ->icon('heroicon-o-check-circle')
                ->requiresConfirmation(),

            Action::make('approve')
                ->label('Approve')
                ->visible(fn(Model $record) => $record->serviceRequests->last()?->status === 'verified')
                ->action(function (Model $record) {
                    $serviceRequest = $record->serviceRequests->last();
                    if ($serviceRequest) {
                        $serviceRequest->update([
                            'status' => 'approved',
                            'completion_date' => now()
                        ]);
                    }
                })
                ->color('success')
                ->icon('heroicon-o-check')
                ->requiresConfirmation(),

            Action::make('reject')
                ->label('Reject')
                ->visible(fn(Model $record) => $record->serviceRequests->last()?->status !== 'approved' && $record->serviceRequests->last()?->status !== 'rejected')
                ->action(function (Model $record, array $data) {
                    $serviceRequest = $record->serviceRequests->last();

                    if ($serviceRequest) {
                        // Create a new VerificationDetail record
                        VerificationDetail::create([
                            'reject_message' => $data['reject_message'],
                        ]);

                        // Update the service request status to "verified"
                        $serviceRequest->update([
                            'status' => 'rejected',
                            'completion_date' => now()
                        ]);
                    }
                })
                ->form([
                    TextInput::make('reject_message')
                        ->label('Reject Message')
                        ->required(),
                ])
                ->color('danger')
                ->icon('heroicon-o-x-circle')
                ->requiresConfirmation(),
        ];
    }
}
