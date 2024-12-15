<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VerificationDetailResource\Pages;
use App\Filament\Resources\VerificationDetailResource\RelationManagers;
use App\Models\VerificationDetail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VerificationDetailResource extends Resource
{
    protected static ?string $model = VerificationDetail::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('service_request_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('officer_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('form_no')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\DatePicker::make('form_date'),
                Forms\Components\TextInput::make('family_cost_no')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('municipality')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('ward')
                    ->numeric()
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('service_request_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('officer_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('form_no')
                    ->searchable(),
                Tables\Columns\TextColumn::make('form_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('family_cost_no')
                    ->searchable(),
                Tables\Columns\TextColumn::make('municipality')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ward')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListVerificationDetails::route('/'),
            'create' => Pages\CreateVerificationDetail::route('/create'),
            'view' => Pages\ViewVerificationDetail::route('/{record}'),
            'edit' => Pages\EditVerificationDetail::route('/{record}/edit'),
        ];
    }
}
