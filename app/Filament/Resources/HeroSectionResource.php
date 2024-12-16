<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeroSectionResource\Pages;
use App\Models\HeroSection;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class HeroSectionResource extends Resource
{
    protected static ?string $model = HeroSection::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Basic Details')
                    ->schema([
                        TextInput::make('tagline')
                            ->label('Tagline')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('title')
                            ->label('Title')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('description')
                            ->label('Description')
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Fieldset::make('Buttons')
                    ->schema([
                        TextInput::make('button1_text')
                            ->label('Button 1 Text')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('button1_link')
                            ->label('Button 1 Link')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('button2_text')
                            ->label('Button 2 Text')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('button2_link')
                            ->label('Button 2 Link')
                            ->required()
                            ->maxLength(255),
                    ]),

                Fieldset::make('Media')
                    ->schema([
                        FileUpload::make('featured_image')
                            ->label('Featured Image')
                            ->image()
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tagline')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('featured_image'),
                Tables\Columns\TextColumn::make('button1_text')
                    ->searchable(),
                Tables\Columns\TextColumn::make('button1_link')
                    ->searchable(),
                Tables\Columns\TextColumn::make('button2_text')
                    ->searchable(),
                Tables\Columns\TextColumn::make('button2_link')
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
            'index' => Pages\ListHeroSections::route('/'),
            'create' => Pages\CreateHeroSection::route('/create'),
            'view' => Pages\ViewHeroSection::route('/{record}'),
            'edit' => Pages\EditHeroSection::route('/{record}/edit'),
        ];
    }
}
