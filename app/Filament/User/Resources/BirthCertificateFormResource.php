<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\BirthCertificateFormResource\Pages;
use App\Filament\User\Resources\BirthCertificateFormResource\RelationManagers;
use App\Models\BirthCertificateForm;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components;
use Filament\Forms\Components\Repeater;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\MorphToSelect;
use Filament\Forms\Components\MorphToSelect\Type;

class BirthCertificateFormResource extends Resource
{
    protected static ?string $model = BirthCertificateForm::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('Service Request Status')
                    ->schema([
                        Repeater::make('service_requests')
                            ->relationship('serviceRequests')
                            ->label('')
                            ->schema([
                                Forms\Components\TextInput::make('user_id')
                                    ->default(fn() => Auth::id())
                                    ->required()
                                    ->numeric()
                                    ->readOnly(),

                                Forms\Components\Select::make('related_request_type')
                                    ->options([
                                        BirthCertificateForm::class => 'Birth Certificate Form',
                                        // Add other models here
                                    ])
                                    ->label('Related Request Type')
                                    ->required(),

                                Forms\Components\Select::make('status')
                                    ->options([
                                        'pending' => 'Pending',
                                        'verified' => 'Verified',
                                        'approved' => 'Approved',
                                        'rejected' => 'Rejected',
                                    ])
                                    ->default('pending')
                                    ->label('Status')
                                    ->disabled()
                                    ->required(),
                            ])
                            ->defaultItems(1)
                            ->columns(3)
                            ->columnSpanFull()
                            ->deletable(false)
                            ->disableItemCreation(),

                    ]),

                Forms\Components\Fieldset::make('Birth Certificate Form Details')
                    ->schema([
                        Components\Section::make('Personal Information')
                            ->description('Enter the personal details of the individual.')
                            ->schema([
                                Components\Grid::make(3)
                                    ->schema([
                                        Components\TextInput::make('n_first_name')
                                            ->label('First Name (Nepali)')
                                            ->required()
                                            ->maxLength(100),
                                        Components\TextInput::make('n_middle_name')
                                            ->label('Middle Name (Nepali)')
                                            ->maxLength(100)
                                            ->nullable(),
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
                                            ->nullable(),
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
                                Components\Grid::make(3)
                                    ->schema([
                                        Components\Select::make('birth_type')
                                            ->label('Birth Type')
                                            ->options([
                                                'single' => 'Single',
                                                'twins' => 'Twins',
                                                'tripletsOrMore' => 'Triplets or More',
                                            ])
                                            ->required(),
                                        Components\Select::make('birth_attendant_type')
                                            ->label('Birth Attendant Type')
                                            ->options([
                                                'doctor' => 'Doctor',
                                                'nurse' => 'Nurse',
                                                'localSudini' => 'Local Sudini',
                                                'trainedSudini' => 'Trained Sudini',
                                                'familyMembers' => 'Family Members',
                                                'others' => 'Others',
                                            ])
                                            ->required(),
                                        Components\Select::make('birth_place')
                                            ->label('Place of Birth')
                                            ->options([
                                                'home' => 'Home',
                                                'healthpost' => 'Health Post',
                                                'hospital' => 'Hospital',
                                                'other' => 'Other',
                                            ])
                                            ->required(),
                                    ]),
                                Components\Grid::make(2)
                                    ->schema([
                                        Components\Toggle::make('is_weight_taken')
                                            ->label('Is Birth Weight Taken?')
                                            ->reactive(), // Make the toggle reactive to trigger changes in dependent fields

                                        Components\TextInput::make('birth_weight')
                                            ->label('Birth Weight (in grams)')
                                            ->numeric()
                                            ->nullable()
                                            ->required()
                                            ->visible(fn($get) => $get('is_weight_taken')), // Show only if 'is_weight_taken' is true
                                    ]),
                            ]),

                        Components\Section::make('Disabled Details')
                            ->description('If the child is disabled.')
                            ->schema([
                                Components\Grid::make(1)
                                    ->schema([
                                        Components\TextArea::make('disable_type')
                                            ->label('Disabled Type')
                                            ->nullable(),
                                    ])
                            ]),

                        Components\Section::make('Birth Details')
                            ->description('Enter the details related to the place of birth.')
                            ->schema([
                                Components\Grid::make(3)
                                    ->schema([

                                        Components\TextInput::make('birth_province')
                                            ->label('Province')
                                            ->maxLength(50)
                                            ->nullable(),
                                        Components\TextInput::make('birth_municipality')
                                            ->label('Municipality')
                                            ->maxLength(100)
                                            ->nullable(),
                                        Components\TextInput::make('birth_ward')
                                            ->label('Ward Number')
                                            ->numeric()
                                            ->nullable(),

                                    ]),
                            ]),

                        Components\Section::make('Birt Place Details')
                            ->description('If the child has born in foreign country.')
                            ->schema([
                                Components\Grid::make(3)
                                    ->schema([
                                        Components\TextInput::make('birth_country')
                                            ->label('Country')
                                            ->maxLength(100)
                                            ->nullable(),
                                        Components\TextInput::make('birth_state')
                                            ->label('State')
                                            ->maxLength(100)
                                            ->nullable(),
                                        Components\TextInput::make('birth_local_address')
                                            ->label('Local Address')
                                            ->maxLength(255)
                                            ->nullable(),
                                    ])
                            ]),

                        Components\Section::make('Parents Details')
                            ->description('Enter the details of the child’s parents.')
                            ->schema([
                                Components\Tabs::make('Parent Details')
                                    ->tabs([
                                        Components\Tabs\Tab::make('Grandfather')
                                            ->schema([
                                                Components\Grid::make(3)
                                                    ->schema([
                                                        Components\TextInput::make('n_grandfather_first_name')
                                                            ->label('Grandfather\'s First Name (Nepali)')
                                                            ->maxLength(100)
                                                            ->nullable(),
                                                        Components\TextInput::make('n_grandfather_middle_name')
                                                            ->label('Grandfather\'s Middle Name (Nepali)')
                                                            ->maxLength(100)
                                                            ->nullable(),
                                                        Components\TextInput::make('n_grandfather_last_name')
                                                            ->label('Grandfather\'s Last Name (Nepali)')
                                                            ->maxLength(100)
                                                            ->nullable(),
                                                        Components\TextInput::make('e_grandfather_first_name')
                                                            ->label('Grandfather\'s First Name (English)')
                                                            ->maxLength(100)
                                                            ->nullable(),
                                                        Components\TextInput::make('e_grandfather_middle_name')
                                                            ->label('Grandfather\'s Middle Name (English)')
                                                            ->maxLength(100)
                                                            ->nullable(),
                                                        Components\TextInput::make('e_grandfather_last_name')
                                                            ->label('Grandfather\'s Last Name (English)')
                                                            ->maxLength(100)
                                                            ->nullable(),
                                                    ]),
                                            ]),


                                        Components\Tabs\Tab::make('Father')
                                            ->schema([
                                                Components\Grid::make(3)
                                                    ->schema([
                                                        Components\TextInput::make('n_father_first_name')
                                                            ->label('Father\'s First Name (Nepali)')
                                                            ->maxLength(100)
                                                            ->nullable(),
                                                        Components\TextInput::make('n_father_middle_name')
                                                            ->label('Father\'s Middle Name (Nepali)')
                                                            ->maxLength(100)
                                                            ->nullable(),
                                                        Components\TextInput::make('n_father_last_name')
                                                            ->label('Father\'s Last Name (Nepali)')
                                                            ->maxLength(100)
                                                            ->nullable(),
                                                        Components\TextInput::make('e_father_first_name')
                                                            ->label('Father\'s First Name (English)')
                                                            ->maxLength(100)
                                                            ->nullable(),
                                                        Components\TextInput::make('e_father_middle_name')
                                                            ->label('Father\'s Middle Name (English)')
                                                            ->maxLength(100)
                                                            ->nullable(),
                                                        Components\TextInput::make('e_father_last_name')
                                                            ->label('Father\'s Last Name (English)')
                                                            ->maxLength(100)
                                                            ->nullable(),
                                                    ]),
                                                Components\Grid::make(3)
                                                    ->schema([
                                                        Components\TextInput::make('father_province')
                                                            ->label('Province')
                                                            ->maxLength(50)
                                                            ->nullable(),
                                                        Components\TextInput::make('father_municipality')
                                                            ->label('Municipality')
                                                            ->maxLength(100)
                                                            ->nullable(),
                                                        Components\TextInput::make('father_ward')
                                                            ->label('Ward Number')
                                                            ->numeric()
                                                            ->nullable(),
                                                        Components\TextInput::make('father_street')
                                                            ->label('Street')
                                                            ->maxLength(100)
                                                            ->nullable(),
                                                        Components\TextInput::make('father_village')
                                                            ->label('Village')
                                                            ->maxLength(100)
                                                            ->nullable(),
                                                        Components\TextInput::make('father_house_no')
                                                            ->label('House Number')
                                                            ->numeric()
                                                            ->nullable(),
                                                        Components\TextInput::make('father_citizenship_no')
                                                            ->label('Citizenship Number')
                                                            ->maxLength(50)
                                                            ->nullable(),
                                                        Components\DatePicker::make('father_dob')
                                                            ->label('Date of Birth')
                                                            ->nullable(),
                                                        Components\TextInput::make('father_education')
                                                            ->label('Education')
                                                            ->maxLength(100)
                                                            ->nullable(),
                                                        Components\TextArea::make('father_occupation')
                                                            ->label('Occupation')
                                                            ->rows(3)
                                                            ->nullable(),
                                                        Components\TextInput::make('father_religion')
                                                            ->label('Religion')
                                                            ->maxLength(50)
                                                            ->nullable(),
                                                        Components\TextInput::make('father_cast')
                                                            ->label('Caste')
                                                            ->maxLength(50)
                                                            ->nullable(),

                                                    ]),
                                            ]),
                                        Components\Tabs\Tab::make('Mother')
                                            ->schema([
                                                Components\Grid::make(3)
                                                    ->schema([
                                                        Components\TextInput::make('n_mother_first_name')
                                                            ->label('Mother\'s First Name (Nepali)')
                                                            ->maxLength(100)
                                                            ->nullable(),
                                                        Components\TextInput::make('n_mother_middle_name')
                                                            ->label('Mother\'s Middle Name (Nepali)')
                                                            ->maxLength(100)
                                                            ->nullable(),
                                                        Components\TextInput::make('n_mother_last_name')
                                                            ->label('Mother\'s Last Name (Nepali)')
                                                            ->maxLength(100)
                                                            ->nullable(),
                                                        Components\TextInput::make('e_mother_first_name')
                                                            ->label('Mother\'s First Name (English)')
                                                            ->maxLength(100)
                                                            ->nullable(),
                                                        Components\TextInput::make('e_mother_middle_name')
                                                            ->label('Mother\'s Middle Name (English)')
                                                            ->maxLength(100)
                                                            ->nullable(),
                                                        Components\TextInput::make('e_mother_last_name')
                                                            ->label('Mother\'s Last Name (English)')
                                                            ->maxLength(100)
                                                            ->nullable(),
                                                    ]),
                                                Components\Grid::make(3)
                                                    ->schema([
                                                        Components\TextInput::make('mother_province')
                                                            ->label('Province')
                                                            ->maxLength(50)
                                                            ->nullable(),
                                                        Components\TextInput::make('mother_municipality')
                                                            ->label('Municipality')
                                                            ->maxLength(100)
                                                            ->nullable(),
                                                        Components\TextInput::make('mother_ward')
                                                            ->label('Ward Number')
                                                            ->numeric()
                                                            ->nullable(),
                                                        Components\TextInput::make('mother_street')
                                                            ->label('Street')
                                                            ->maxLength(100)
                                                            ->nullable(),
                                                        Components\TextInput::make('mother_village')
                                                            ->label('Village')
                                                            ->maxLength(100)
                                                            ->nullable(),
                                                        Components\TextInput::make('mother_house_no')
                                                            ->label('House Number')
                                                            ->numeric()
                                                            ->nullable(),
                                                        Components\TextInput::make('mother_citizenship_no')
                                                            ->label('Citizenship Number')
                                                            ->maxLength(50)
                                                            ->nullable(),
                                                        Components\DatePicker::make('mother_dob')
                                                            ->label('Date of Birth')
                                                            ->nullable(),
                                                        Components\TextInput::make('mother_education')
                                                            ->label('Education')
                                                            ->maxLength(100)
                                                            ->nullable(),
                                                        Components\TextArea::make('mother_occupation')
                                                            ->label('Occupation')
                                                            ->rows(3)
                                                            ->nullable(),
                                                        Components\TextInput::make('mother_religion')
                                                            ->label('Religion')
                                                            ->maxLength(50)
                                                            ->nullable(),
                                                        Components\TextInput::make('mother_cast')
                                                            ->label('Caste')
                                                            ->maxLength(50)
                                                            ->nullable(),

                                                    ]),
                                            ]),

                                    ]),
                            ]),

                        Components\Section::make('Parent Details')
                            ->description('If the parents are from foreign country.')
                            ->schema([
                                Components\Grid::make(2)
                                    ->schema([
                                        Components\TextInput::make('father_passport_no')
                                            ->label('Father\'s Passport Number')
                                            ->maxLength(50)
                                            ->nullable(),
                                        Components\TextInput::make('father_country')
                                            ->label('Father\'s Country')
                                            ->maxLength(100)
                                            ->nullable(),
                                        Components\TextInput::make('mother_passport_no')
                                            ->label('Mother\'s Passport Number')
                                            ->maxLength(50)
                                            ->nullable(),
                                        Components\TextInput::make('mother_country')
                                            ->label('Mother\'s Country')
                                            ->maxLength(100)
                                            ->nullable(),

                                    ])
                            ]),

                        Components\Section::make('Parent Marriage Details')
                            ->description('Enter the parent\'s marriage details.')
                            ->schema([
                                Components\Grid::make(2)
                                    ->schema([
                                        Components\TextInput::make('marriage_registration_no')
                                            ->label('Marriage Registration Number')
                                            ->maxLength(50)
                                            ->nullable(),
                                        Components\DatePicker::make('marriage_date')
                                            ->label('Marriage Date')
                                            ->nullable(),
                                    ])
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
                                            ->nullable(),
                                        Components\TextInput::make('n_informer_last_name')
                                            ->label('Informer\'s Last Name (Nepali)')
                                            ->required()
                                            ->maxLength(100),

                                        Components\TextInput::make('e_informer_first_name')
                                            ->label('Informer\'s First Name (English)')
                                            ->required()
                                            ->maxLength(100),
                                        Components\TextInput::make('e_informer_middle_name')
                                            ->label('Informer\'s Middle Name (English)')
                                            ->maxLength(100)
                                            ->nullable(),
                                        Components\TextInput::make('e_informer_last_name')
                                            ->label('Informer\'s Last Name (English)')
                                            ->required()
                                            ->maxLength(100),
                                    ]),
                                Components\Grid::make(4)
                                    ->schema([
                                        Components\TextInput::make('informer_relation_with_child')
                                            ->label('Relation with Child')
                                            ->required()
                                            ->maxLength(50),
                                        Components\TextInput::make('citizenship_number')
                                            ->label('Citizenship Number')
                                            ->maxLength(50)
                                            ->nullable(),
                                        Components\TextInput::make('passport_number')
                                            ->label('Passport Number (if foreigner)')
                                            ->maxLength(50)
                                            ->nullable(),
                                        Components\TextInput::make('issued_country')
                                            ->label('Passport Issued Country')
                                            ->maxLength(100)
                                            ->nullable(),
                                    ])

                            ]),
                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('n_first_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('n_middle_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('n_surname')
                    ->searchable(),
                Tables\Columns\TextColumn::make('e_first_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('e_middle_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('e_surname')
                    ->searchable(),
                Tables\Columns\TextColumn::make('birth_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('gender'),
                Tables\Columns\TextColumn::make('birth_type'),
                Tables\Columns\IconColumn::make('is_weight_taken')
                    ->boolean(),
                Tables\Columns\TextColumn::make('birth_weight')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('birth_attendant_type')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('birth_place'),
                Tables\Columns\TextColumn::make('birth_province')
                    ->searchable(),
                Tables\Columns\TextColumn::make('birth_municipality')
                    ->searchable(),
                Tables\Columns\TextColumn::make('birth_ward')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('n_birth_country')
                    ->searchable(),
                Tables\Columns\TextColumn::make('n_birth_state')
                    ->searchable(),
                Tables\Columns\TextColumn::make('n_birth_local_address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('e_birth_country')
                    ->searchable(),
                Tables\Columns\TextColumn::make('e_birth_state')
                    ->searchable(),
                Tables\Columns\TextColumn::make('e_birth_local_address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('n_grandfather_first_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('n_grandfather_middle_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('n_grandfather_last_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('e_grandfather_first_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('e_grandfather_middle_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('e_grandfather_last_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('n_father_first_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('n_father_middle_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('n_father_last_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('e_father_first_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('e_father_middle_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('e_father_last_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('n_mother_first_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('n_mother_middle_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('n_mother_last_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('e_mother_first_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('e_mother_middle_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('e_mother_last_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('father_province')
                    ->searchable(),
                Tables\Columns\TextColumn::make('father_municipality')
                    ->searchable(),
                Tables\Columns\TextColumn::make('father_ward')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('father_street')
                    ->searchable(),
                Tables\Columns\TextColumn::make('father_village')
                    ->searchable(),
                Tables\Columns\TextColumn::make('father_house_no')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('father_citizenship_no')
                    ->searchable(),
                Tables\Columns\TextColumn::make('father_dob')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('father_education')
                    ->searchable(),
                Tables\Columns\TextColumn::make('father_religion')
                    ->searchable(),
                Tables\Columns\TextColumn::make('father_cast')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mother_province')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mother_municipality')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mother_ward')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('mother_street')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mother_village')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mother_house_no')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('mother_citizenship_no')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mother_dob')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('mother_education')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mother_religion')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mother_cast')
                    ->searchable(),
                Tables\Columns\TextColumn::make('father_passport_no')
                    ->searchable(),
                Tables\Columns\TextColumn::make('father_country')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mother_passport_no')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mother_country')
                    ->searchable(),
                Tables\Columns\TextColumn::make('marriage_registration_no')
                    ->searchable(),
                Tables\Columns\TextColumn::make('marriage_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('n_informer_first_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('n_informer_middle_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('n_informer_last_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('e_informer_first_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('e_informer_middle_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('e_informer_last_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('informer_relation_with_child')
                    ->searchable(),
                Tables\Columns\TextColumn::make('citizenship_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('e_passport_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('n_passport_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('e_issued_country')
                    ->searchable(),
                Tables\Columns\TextColumn::make('n_issued_country')
                    ->searchable(),
                Tables\Columns\TextColumn::make('form_filled_date')
                    ->date()
                    ->sortable(),
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
            'index' => Pages\ListBirthCertificateForms::route('/'),
            'create' => Pages\CreateBirthCertificateForm::route('/create'),
            'view' => Pages\ViewBirthCertificateForm::route('/{record}'),
            'edit' => Pages\EditBirthCertificateForm::route('/{record}/edit'),
        ];
    }
}
