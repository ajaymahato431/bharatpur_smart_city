<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OfficerActivityResource\Pages;
use App\Filament\Resources\OfficerActivityResource\RelationManagers;
use App\Models\OfficerActivity;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OfficerActivityResource extends Resource
{
    protected static ?string $model = OfficerActivity::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('officer_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('service_request_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('action')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('officer_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('service_request_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('action')
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
            'index' => Pages\ListOfficerActivities::route('/'),
            'create' => Pages\CreateOfficerActivity::route('/create'),
            'view' => Pages\ViewOfficerActivity::route('/{record}'),
            'edit' => Pages\EditOfficerActivity::route('/{record}/edit'),
        ];
    }
}
