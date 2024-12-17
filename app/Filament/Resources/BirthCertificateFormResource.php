<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BirthCertificateFormResource\Pages;
use App\Filament\Resources\BirthCertificateFormResource\RelationManagers\ServiceRequestsRelationManager;
use App\Models\BirthCertificateForm;
use App\Models\VerificationDetail;
use Filament\Forms;
use Filament\Forms\Components;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder; // Import Eloquent Builder
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
                                Forms\Components\Select::make('user_id')
                                    ->relationship('users', 'name')
                                    // ->default(fn () => Auth::id())
                                    ->required(),

                                Forms\Components\Select::make('email')
                                    ->relationship('users', 'email')
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

                                Forms\Components\Select::make('related_request_type')
                                    ->options([
                                        BirthCertificateForm::class => 'Birth Certificate Form',
                                        // Add other models here
                                    ])
                                    ->label('Related Request Type')
                                    ->required(),

                                Forms\Components\DatePicker::make('submission_date')
                                    ->required(),
                                Forms\Components\DatePicker::make('verification_date')
                                    ->required(),
                                Forms\Components\DatePicker::make('completion_date')
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
                                                'Male/पुरुष' => 'Male/पुरुष',
                                                'Female/महिला' => 'Female/महिला',
                                                'Other/अन्य' => 'Other/अन्य',
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
                                            ->visible(fn ($get) => $get('is_weight_taken')), // Show only if 'is_weight_taken' is true
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
                                    ]),
                            ]),

                        Components\Section::make('Birth Details')
                            ->description('Enter the details related to the place of birth.')
                            ->schema([
                                Components\Grid::make(3)
                                    ->schema([

                                        Components\TextInput::make('n_birth_province')
                                            ->label('Province')
                                            ->maxLength(50)
                                            ->nullable(),
                                        Components\TextInput::make('n_birth_district')
                                            ->label('Province')
                                            ->maxLength(50)
                                            ->nullable(),
                                        Components\TextInput::make('n_birth_municipality')
                                            ->label('Municipality')
                                            ->maxLength(100)
                                            ->nullable(),
                                        Components\TextInput::make('n_birth_ward')
                                            ->label('Ward Number')
                                            ->numeric()
                                            ->nullable(),
                                        Components\TextInput::make('e_birth_province')
                                            ->label('Province')
                                            ->maxLength(50)
                                            ->nullable(),
                                        Components\TextInput::make('e_birth_district')
                                            ->label('Province')
                                            ->maxLength(50)
                                            ->nullable(),
                                        Components\TextInput::make('e_birth_municipality')
                                            ->label('Municipality')
                                            ->maxLength(100)
                                            ->nullable(),
                                        Components\TextInput::make('e_birth_ward')
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
                                    ]),
                            ]),

                        Components\Section::make('Child Permanent Address')
                            ->description('Enter the permananet address of child.')
                            ->schema([
                                Components\Grid::make(3)
                                    ->schema([

                                        Components\TextInput::make('n_permanent_province')
                                            ->label('Province')
                                            ->maxLength(50)
                                            ->nullable(),
                                        Components\TextInput::make('n_permanent_district')
                                            ->label('Province')
                                            ->maxLength(50)
                                            ->nullable(),
                                        Components\TextInput::make('n_permanent_municipality')
                                            ->label('Municipality')
                                            ->maxLength(100)
                                            ->nullable(),
                                        Components\TextInput::make('n_permanent_ward')
                                            ->label('Ward Number')
                                            ->numeric()
                                            ->nullable(),
                                        Components\TextInput::make('e_permanent_province')
                                            ->label('Province')
                                            ->maxLength(50)
                                            ->nullable(),
                                        Components\TextInput::make('e_permanent_district')
                                            ->label('Province')
                                            ->maxLength(50)
                                            ->nullable(),
                                        Components\TextInput::make('e_permanent_municipality')
                                            ->label('Municipality')
                                            ->maxLength(100)
                                            ->nullable(),
                                        Components\TextInput::make('e_permanent_ward')
                                            ->label('Ward Number')
                                            ->numeric()
                                            ->nullable(),

                                    ]),
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

                                    ]),
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
                                        Components\TextInput::make('informer_citizenship_no')
                                            ->label('Citizenship Number')
                                            ->maxLength(50)
                                            ->nullable(),
                                        Components\TextInput::make('informer_passport_number')
                                            ->label('Passport Number (if foreigner)')
                                            ->maxLength(50)
                                            ->nullable(),
                                        Components\TextInput::make('informer_issued_country')
                                            ->label('Passport Issued Country')
                                            ->maxLength(100)
                                            ->nullable(),
                                    ]),

                            ]),
                    ]),

                Forms\Components\Fieldset::make('Birth Certificate Form Documents')
                    ->schema([
                        Repeater::make('birth_documents')
                            ->relationship('birthDocuments')
                            ->label('')
                            ->schema([
                                Components\FileUpload::make('citizenship_front')
                                    ->label('Citizenship Front')
                                    ->reactive()
                                    ->visible(fn (Forms\Get $get) => ! ($get('../../mother_passport_no') || $get('../../father_passport_no'))),

                                Components\FileUpload::make('citizenship_back')
                                    ->label('Citizenship Back')
                                    ->reactive()
                                    ->visible(fn (Forms\Get $get) => ! ($get('../../mother_passport_no') || $get('../../father_passport_no'))),

                                Components\FileUpload::make('passport_copy')
                                    ->label('Passport Copy')
                                    ->reactive()
                                    ->visible(fn (Forms\Get $get) => $get('../../mother_passport_no') || $get('../../father_passport_no')),

                                Components\FileUpload::make('ward_residence_proof')
                                    ->label('Ward Residence Proof')
                                    ->reactive()
                                    ->visible(fn (Forms\Get $get) => $get('../../mother_passport_no') || $get('../../father_passport_no')),

                                Components\FileUpload::make('hospital_birth_report')
                                    ->label('Hospital Birth Report')
                                    ->reactive()
                                    ->hidden(fn (Forms\Get $get) => ! in_array($get('../../birth_place'), ['healthpost', 'hospital'])),

                                Components\FileUpload::make('last_vaccine_proof')
                                    ->label('Last Vaccine Proof')
                                    ->reactive()
                                    ->hidden(fn (Forms\Get $get) => in_array($get('../../birth_place'), ['healthpost', 'hospital'])),

                                Components\FileUpload::make('indian_citizen_proof')
                                    ->label('Indian Citizen Proof (In the case of Indian Citizen)'),

                                Components\FileUpload::make('nofather_police_report')
                                    ->label('No-Father Police Report (In the case of  no information of father)'),
                            ])
                            ->defaultItems(1)
                            ->columns(3)
                            ->columnSpanFull()
                            ->deletable(false)
                            ->disableItemCreation(),
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('e_first_name')
                    ->label('Child Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('e_surname')
                    ->label('Child Surname')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('serviceRequests.related_request_type')
                    ->formatStateUsing(fn ($state) => [
                        BirthCertificateForm::class => 'Birth Certificate Form',
                        // Add other models here
                    ][$state] ?? $state)
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('serviceRequests.status')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->colors([
                        'danger' => 'rejected', // Red for rejected
                        'success' => 'approved', // Green for approved
                        'warning' => 'pending', // Yellow for pending
                    ]),
                Tables\Columns\TextColumn::make('serviceRequests.submission_date')
                    ->label('Submission Date')
                    ->date()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('serviceRequests.verification_date')
                //     ->date()
                //     ->label('Verification Date')
                //     ->sortable(),
                Tables\Columns\TextColumn::make('serviceRequests.completion_date')
                    ->date()
                    ->label('Completion Date')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([

                Action::make('mark_verified')
                    ->label('Verify')
                    ->visible(fn (Model $record) => $record->serviceRequests->last()?->status === 'pending')
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
                        Forms\Components\TextInput::make('form_no')
                            ->label('Form Number')
                            ->unique('verification_details', 'form_no')
                            ->required(),

                        Forms\Components\DatePicker::make('form_date')
                            ->label('Form Date')
                            ->default(now())
                            ->required()
                            ->disabled(),

                        Forms\Components\TextInput::make('family_cost_no')
                            ->label('Family Cost Number')
                            ->required(),

                        Forms\Components\TextInput::make('municipality')
                            ->label('Municipality')
                            ->default('Bharatpur')
                            ->required(),

                        Forms\Components\TextInput::make('ward')
                            ->label('Ward')
                            ->default(10)
                            ->required(),
                    ])
                    ->color('primary')
                    ->icon('heroicon-o-check-circle')
                    ->requiresConfirmation(),

                Action::make('approve')
                    ->label('Approve')
                    ->visible(fn (Model $record) => $record->serviceRequests->last()?->status === 'verified')
                    ->action(function (Model $record) {
                        $serviceRequest = $record->serviceRequests->last();
                        if ($serviceRequest) {
                            $serviceRequest->update([
                                'status' => 'approved',
                                'completion_date' => now(),
                            ]);
                        }
                    })
                    ->color('success')
                    ->icon('heroicon-o-check')
                    ->requiresConfirmation(),

                Action::make('reject')
                    ->label('Reject')
                    ->visible(fn (Model $record) => $record->serviceRequests->last()?->status !== 'approved' && $record->serviceRequests->last()?->status !== 'rejected')
                    ->action(function (Model $record, array $data) {
                        $serviceRequest = $record->serviceRequests->last();

                        if ($serviceRequest) {

                            // Update the service request status to "verified"
                            $serviceRequest->update([
                                'status' => 'rejected',
                                'reject_message' => $data['reject_message'],
                                'completion_date' => now(),
                            ]);
                        }
                    })
                    ->form([
                        Forms\Components\TextInput::make('reject_message')
                            ->label('Reject Message')
                            ->required(),
                    ])
                    ->color('danger')
                    ->icon('heroicon-o-x-circle')
                    ->requiresConfirmation(),

                Action::make('Download Certificate')
                    ->visible(fn (Model $record) => $record->serviceRequests->last()?->status === 'approved')
                    ->url(fn ($record) => route('birth-certificate.pdf', $record->id))
                    ->openUrlInNewTab()
                    ->label('Download Certificate')
                    ->icon('heroicon-o-arrow-down-tray'),

                Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),

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
            ServiceRequestsRelationManager::class,
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
