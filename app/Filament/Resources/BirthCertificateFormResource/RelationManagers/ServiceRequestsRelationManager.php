<?php

namespace App\Filament\Resources\BirthCertificateFormResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceRequestsRelationManager extends RelationManager
{
    protected static string $relationship = 'serviceRequests';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('verificationDetails.officers.name')
                    ->label('Verified By'),
                Tables\Columns\TextColumn::make('verificationDetails.officers.officerDetails.staff_no')
                    ->label('Staff ID'),
                Tables\Columns\TextColumn::make('verificationDetails.form_no')
                    ->label('Form Registration No'),
                Tables\Columns\TextColumn::make('verificationDetails.form_date')
                    ->label('Form Registration Date'),
                Tables\Columns\TextColumn::make('verificationDetails.family_cost_no')
                    ->label('Family Cost No'),
                Tables\Columns\TextColumn::make('verificationDetails.municipality')
                    ->label('Municipality'),
                Tables\Columns\TextColumn::make('verificationDetails.ward')
                    ->label('Ward'),
            ])->paginated(false)
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
