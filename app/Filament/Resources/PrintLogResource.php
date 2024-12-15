<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PrintLogResource\Pages;
use App\Filament\Resources\PrintLogResource\RelationManagers;
use App\Models\PrintLog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PrintLogResource extends Resource
{
    protected static ?string $model = PrintLog::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('service_certificate_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('action_type')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('officer_id')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('service_certificate_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('action_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('officer_id')
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
            'index' => Pages\ListPrintLogs::route('/'),
            'create' => Pages\CreatePrintLog::route('/create'),
            'view' => Pages\ViewPrintLog::route('/{record}'),
            'edit' => Pages\EditPrintLog::route('/{record}/edit'),
        ];
    }
}
