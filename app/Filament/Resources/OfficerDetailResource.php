<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OfficerDetailResource\Pages;
use App\Filament\Resources\OfficerDetailResource\RelationManagers;
use App\Models\OfficerDetail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OfficerDetailResource extends Resource
{
    protected static ?string $model = OfficerDetail::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('officer_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('staff_no')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('citizenship_no')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('citizenship_front_image')
                    ->image()
                    ->required(),
                Forms\Components\FileUpload::make('citizenship_back_image')
                    ->image()
                    ->required(),
                Forms\Components\TextInput::make('job_position')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('ward_no')
                    ->required()
                    ->numeric()
                    ->default(10),
                Forms\Components\TextInput::make('address')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('dob')
                    ->required(),
                Forms\Components\TextInput::make('gender')
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
                Tables\Columns\TextColumn::make('staff_no')
                    ->searchable(),
                Tables\Columns\TextColumn::make('citizenship_no')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('citizenship_front_image'),
                Tables\Columns\ImageColumn::make('citizenship_back_image'),
                Tables\Columns\TextColumn::make('job_position')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ward_no')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dob')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('gender')
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
            'index' => Pages\ListOfficerDetails::route('/'),
            'create' => Pages\CreateOfficerDetail::route('/create'),
            'view' => Pages\ViewOfficerDetail::route('/{record}'),
            'edit' => Pages\EditOfficerDetail::route('/{record}/edit'),
        ];
    }
}
