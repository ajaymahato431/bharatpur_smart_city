<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceRequestResource\Pages;
use App\Filament\Resources\ServiceRequestResource\RelationManagers;
use App\Models\ServiceRequest;
use Filament\Forms;
use Filament\Forms\Components\MorphToSelect;
use Filament\Forms\Components\MorphToSelect\Type;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components;


class ServiceRequestResource extends Resource
{
    protected static ?string $model = ServiceRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                // Service ID Dropdown
                Forms\Components\Select::make('service_id')
                    ->relationship('service', 'name')
                    ->required()
                    ->label('Service'),

                // MorphToSelect for Related Request
                MorphToSelect::make('relatedRequest')
                    ->types([
                        Type::make(\App\Models\BirthCertificateForm::class)
                            ->titleAttribute('n_first_name'),
                        // Type::make(\App\Models\MarriageCertificateForm::class)
                        //     ->titleAttribute('certificate_no'),
                    ])
                    ->label('Related Request Type')
                    ->required()
                    ->reactive(), // Make this field reactive

                // Fields for Birth Certificate Form
                Forms\Components\Fieldset::make('Birth Certificate Form Details')
                    ->schema([
                        Components\Card::make([
                            Components\Section::make('Personal Information')
                                ->description('Enter the personal details of the individual.')
                                ->schema([
                                    Components\Grid::make(3) // Use a grid for layout
                                        ->schema([
                                            Components\TextInput::make('n_first_name')
                                                ->label('First Name (Nepali)')
                                                ->required()
                                                ->maxLength(100),
                                            Components\TextInput::make('n_middle_name')
                                                ->label('Middle Name (Nepali)')
                                                ->maxLength(100)
                                                ->default(null),
                                            Components\TextInput::make('n_surname')
                                                ->label('Surname (Nepali)')
                                                ->required()
                                                ->maxLength(100),
                                            Components\TextInput::make('e_first_name')
                                                ->label('First Name (English)')
                                                ->required()
                                                ->maxLength(100),
                                            Components\TextInput::make('e_middle_name')
                                                ->label('Middle Name (English)')
                                                ->maxLength(100)
                                                ->default(null),
                                            Components\TextInput::make('e_surname')
                                                ->label('Surname (English)')
                                                ->required()
                                                ->maxLength(100),
                                        ]),
                                    Components\Grid::make(2)
                                        ->schema([
                                            Components\DatePicker::make('birth_date')
                                                ->label('Date of Birth')
                                                ->required(),
                                            Components\Select::make('gender')
                                                ->label('Gender')
                                                ->options([
                                                    'male' => 'Male',
                                                    'female' => 'Female',
                                                    'other' => 'Other',
                                                ])
                                                ->required(),
                                        ]),
                                    Components\Grid::make(2)
                                        ->schema([
                                            Components\Select::make('birth_type')
                                                ->label('Birth Type')
                                                ->options([
                                                    'normal' => 'Normal',
                                                    'cesarean' => 'Cesarean',
                                                ])
                                                ->required(),
                                            Components\Toggle::make('is_weight_taken')
                                                ->label('Is Birth Weight Taken?'),
                                        ]),
                                    Components\Grid::make(1)
                                        ->schema([
                                            Components\TextInput::make('birth_weight')
                                                ->label('Birth Weight (in kg)')
                                                ->numeric()
                                                ->default(null),
                                        ]),
                                ]),

                            Components\Section::make('Birth Details')
                                ->description('Enter the details related to the place of birth.')
                                ->schema([
                                    Components\Grid::make(3)
                                        ->schema([
                                            Components\TextInput::make('birth_place')
                                                ->label('Place of Birth')
                                                ->required(),
                                            Components\TextInput::make('birth_province')
                                                ->label('Province')
                                                ->maxLength(50)
                                                ->default(null),
                                            Components\TextInput::make('birth_municipality')
                                                ->label('Municipality')
                                                ->maxLength(100)
                                                ->default(null),
                                        ]),
                                    Components\Grid::make(2)
                                        ->schema([
                                            Components\TextInput::make('birth_ward')
                                                ->label('Ward Number')
                                                ->numeric()
                                                ->default(null),
                                            Components\TextInput::make('n_birth_country')
                                                ->label('Country (Nepali)')
                                                ->maxLength(100)
                                                ->default(null),
                                        ]),
                                    Components\RichEditor::make('additional_birth_details')
                                        ->label('Additional Details')
                                        ->toolbarButtons(['bold', 'italic', 'bulletList', 'orderedList', 'link']),
                                ]),

                            Components\Section::make('Parents Details')
                                ->description('Enter the details of the child’s parents.')
                                ->schema([
                                    Components\Tabs::make('Parent Details')
                                        ->tabs([
                                            Components\Tabs\Tab::make('Father')
                                                ->schema([
                                                    Components\Grid::make(3)
                                                        ->schema([
                                                            Components\TextInput::make('n_father_first_name')
                                                                ->label('Father\'s First Name (Nepali)')
                                                                ->maxLength(100)
                                                                ->default(null),
                                                            Components\TextInput::make('n_father_middle_name')
                                                                ->label('Father\'s Middle Name (Nepali)')
                                                                ->maxLength(100)
                                                                ->default(null),
                                                            Components\TextInput::make('n_father_last_name')
                                                                ->label('Father\'s Last Name (Nepali)')
                                                                ->maxLength(100)
                                                                ->default(null),
                                                        ]),
                                                    Components\Grid::make(2)
                                                        ->schema([
                                                            Components\TextInput::make('father_province')
                                                                ->label('Province')
                                                                ->maxLength(50)
                                                                ->default(null),
                                                            Components\TextInput::make('father_municipality')
                                                                ->label('Municipality')
                                                                ->maxLength(100)
                                                                ->default(null),
                                                        ]),
                                                    Components\TextInput::make('father_citizenship_no')
                                                        ->label('Citizenship Number')
                                                        ->maxLength(50)
                                                        ->default(null),
                                                    Components\DatePicker::make('father_dob')
                                                        ->label('Date of Birth'),
                                                    Components\TextArea::make('father_occupation')
                                                        ->label('Occupation')
                                                        ->rows(2)
                                                        ->columnSpan('full'),
                                                ]),
                                            Components\Tabs\Tab::make('Mother')
                                                ->schema([
                                                    Components\Grid::make(3)
                                                        ->schema([
                                                            Components\TextInput::make('n_mother_first_name')
                                                                ->label('Mother\'s First Name (Nepali)')
                                                                ->maxLength(100)
                                                                ->default(null),
                                                            Components\TextInput::make('n_mother_middle_name')
                                                                ->label('Mother\'s Middle Name (Nepali)')
                                                                ->maxLength(100)
                                                                ->default(null),
                                                            Components\TextInput::make('n_mother_last_name')
                                                                ->label('Mother\'s Last Name (Nepali)')
                                                                ->maxLength(100)
                                                                ->default(null),
                                                        ]),
                                                    Components\Grid::make(2)
                                                        ->schema([
                                                            Components\TextInput::make('mother_province')
                                                                ->label('Province')
                                                                ->maxLength(50)
                                                                ->default(null),
                                                            Components\TextInput::make('mother_municipality')
                                                                ->label('Municipality')
                                                                ->maxLength(100)
                                                                ->default(null),
                                                        ]),
                                                    Components\TextInput::make('mother_citizenship_no')
                                                        ->label('Citizenship Number')
                                                        ->maxLength(50)
                                                        ->default(null),
                                                    Components\DatePicker::make('mother_dob')
                                                        ->label('Date of Birth'),
                                                    Components\TextArea::make('mother_occupation')
                                                        ->label('Occupation')
                                                        ->rows(2)
                                                        ->columnSpan('full'),
                                                ]),
                                        ]),
                                ]),

                            Components\Section::make('Informer Details')
                                ->description('Enter the details of the person providing this information.')
                                ->schema([
                                    Components\Grid::make(3)
                                        ->schema([
                                            Components\TextInput::make('n_informer_first_name')
                                                ->label('Informer\'s First Name (Nepali)')
                                                ->required()
                                                ->maxLength(100),
                                            Components\TextInput::make('n_informer_middle_name')
                                                ->label('Informer\'s Middle Name (Nepali)')
                                                ->maxLength(100)
                                                ->default(null),
                                            Components\TextInput::make('n_informer_last_name')
                                                ->label('Informer\'s Last Name (Nepali)')
                                                ->required()
                                                ->maxLength(100),
                                        ]),
                                    Components\TextInput::make('informer_relation_with_child')
                                        ->label('Relation with Child')
                                        ->required()
                                        ->maxLength(50),
                                    Components\TextInput::make('citizenship_number')
                                        ->label('Informer\'s Citizenship Number')
                                        ->maxLength(50)
                                        ->default(null),
                                ]),
                        ]),
                    ])
                    ->visible(fn($get) => $get('related_request_type') === \App\Models\BirthCertificateForm::class),

                // Fields for Marriage Certificate Form
                // Forms\Components\Fieldset::make('Marriage Certificate Form Details')
                //     ->schema([
                //         Forms\Components\TextInput::make('relatedRequest.partner_name')
                //             ->label('Partner Name'),
                //         Forms\Components\TextInput::make('relatedRequest.marriage_place')
                //             ->label('Place of Marriage'),
                //         Forms\Components\DatePicker::make('relatedRequest.marriage_date')
                //             ->label('Date of Marriage'),
                //     ])
                //     ->visible(fn($get) => $get('related_request_type') === \App\Models\MarriageCertificateForm::class),

                // Status Field
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'verified' => 'Verified',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ])
                    ->default('pending')
                    ->label('Status')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('service.name')
                    ->label('Service')
                    ->sortable(),

                Tables\Columns\TextColumn::make('relatedRequest.form_no')
                    ->label('Related Form Number')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'verified' => 'info',
                        'approved' => 'success',
                        'rejected' => 'danger',
                    })
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
            'index' => Pages\ListServiceRequests::route('/'),
            'create' => Pages\CreateServiceRequest::route('/create'),
            'view' => Pages\ViewServiceRequest::route('/{record}'),
            'edit' => Pages\EditServiceRequest::route('/{record}/edit'),
        ];
    }
}
