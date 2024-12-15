<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceCertificateResource\Pages;
use App\Filament\Resources\ServiceCertificateResource\RelationManagers;
use App\Models\ServiceCertificate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceCertificateResource extends Resource
{
    protected static ?string $model = ServiceCertificate::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('service_request_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('certificate_path')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('print_count')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('certificate_number')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('service_request_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('certificate_path')
                    ->searchable(),
                Tables\Columns\TextColumn::make('print_count')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('certificate_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServiceCertificates::route('/'),
            'create' => Pages\CreateServiceCertificate::route('/create'),
            'view' => Pages\ViewServiceCertificate::route('/{record}'),
            'edit' => Pages\EditServiceCertificate::route('/{record}/edit'),
        ];
    }
}
