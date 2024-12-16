<?php

namespace App\Filament\Resources\ServiceRequestResource\Pages;

use App\Filament\Resources\ServiceRequestResource;
use Filament\Actions;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Select;
use Filament\Infolists;
use Filament\Infolists\Infolist;


class ViewServiceRequest extends ViewRecord
{
    protected static string $resource = ServiceRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    // Filament view resource
    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Personal Information')
                    ->description('Details of the individual from the birth certificate form.')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('relatedForm.n_first_name')->label('First Name (Nepali)'),
                                TextEntry::make('relatedForm.n_middle_name')->label('Middle Name (Nepali)'),
                                TextEntry::make('relatedForm.n_surname')->label('Surname (Nepali)'),
                                TextEntry::make('relatedForm.e_first_name')->label('First Name (English)'),
                                TextEntry::make('relatedForm.e_middle_name')->label('Middle Name (English)'),
                                TextEntry::make('relatedForm.e_surname')->label('Surname (English)'),
                            ]),
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('relatedForm.birth_date')->label('Date of Birth'),
                                TextEntry::make('relatedForm.gender')->label('Gender'),
                            ]),
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('relatedForm.birth_type')->label('Birth Type'),
                                TextEntry::make('relatedForm.birth_attendant_type')->label('Birth Attendant Type'),
                                TextEntry::make('relatedForm.birth_place')->label('Place of Birth'),
                            ]),
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('relatedForm.is_weight_taken')->label('Is Birth Weight Taken'),
                                TextEntry::make('relatedForm.birth_weight')->label('Birth Weight (in grams)'),
                            ]),
                    ]),

                Section::make('Disabled Details')
                    ->description('Details if the child is disabled.')
                    ->schema([
                        TextEntry::make('relatedForm.disable_type')->label('Disability Type'),
                    ]),

                Section::make('Birth Details')
                    ->description('Place of birth details.')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('relatedForm.birth_province')->label('Province'),
                                TextEntry::make('relatedForm.birth_municipality')->label('Municipality'),
                                TextEntry::make('relatedForm.birth_ward')->label('Ward Number'),
                            ]),
                    ]),

                Section::make('Birth Place Details')
                    ->description('Details if the child was born in a foreign country.')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('relatedForm.birth_country')->label('Country'),
                                TextEntry::make('relatedForm.birth_state')->label('State'),
                                TextEntry::make('relatedForm.birth_local_address')->label('Local Address'),
                            ]),
                    ]),

                Section::make('Parents Details')
                    ->description('Details of the child’s parents.')
                    ->schema([
                        Tabs::make('Parent Details')
                            ->tabs([
                                Tabs\Tab::make('Grandfather')
                                    ->schema([
                                        Grid::make(3)
                                            ->schema([
                                                TextEntry::make('relatedForm.n_grandfather_first_name')->label('Grandfather\'s First Name (Nepali)'),
                                                TextEntry::make('relatedForm.n_grandfather_middle_name')->label('Grandfather\'s Middle Name (Nepali)'),
                                                TextEntry::make('relatedForm.n_grandfather_last_name')->label('Grandfather\'s Last Name (Nepali)'),
                                                TextEntry::make('relatedForm.e_grandfather_first_name')->label('Grandfather\'s First Name (English)'),
                                                TextEntry::make('relatedForm.e_grandfather_middle_name')->label('Grandfather\'s Middle Name (English)'),
                                                TextEntry::make('relatedForm.e_grandfather_last_name')->label('Grandfather\'s Last Name (English)'),
                                            ]),
                                    ]),
                                Tabs\Tab::make('Father')
                                    ->schema([
                                        Grid::make(3)
                                            ->schema([
                                                TextEntry::make('relatedForm.n_father_first_name')->label('Father\'s First Name (Nepali)'),
                                                TextEntry::make('relatedForm.n_father_middle_name')->label('Father\'s Middle Name (Nepali)'),
                                                TextEntry::make('relatedForm.n_father_last_name')->label('Father\'s Last Name (Nepali)'),
                                                TextEntry::make('relatedForm.e_father_first_name')->label('Father\'s First Name (English)'),
                                                TextEntry::make('relatedForm.e_father_middle_name')->label('Father\'s Middle Name (English)'),
                                                TextEntry::make('relatedForm.e_father_last_name')->label('Father\'s Last Name (English)'),
                                            ]),
                                        Grid::make(3)
                                            ->schema([
                                                TextEntry::make('relatedForm.father_province')->label('Province'),
                                                TextEntry::make('relatedForm.father_municipality')->label('Municipality'),
                                                TextEntry::make('relatedForm.father_ward')->label('Ward Number'),
                                                TextEntry::make('relatedForm.father_street')->label('Street'),
                                                TextEntry::make('relatedForm.father_village')->label('Village'),
                                                TextEntry::make('relatedForm.father_house_no')->label('House Number'),
                                                TextEntry::make('relatedForm.father_citizenship_no')->label('Citizenship Number'),
                                                TextEntry::make('relatedForm.father_dob')->label('Date of Birth'),
                                                TextEntry::make('relatedForm.father_education')->label('Education'),
                                                TextEntry::make('relatedForm.father_occupation')->label('Occupation'),
                                                TextEntry::make('relatedForm.father_religion')->label('Religion'),
                                                TextEntry::make('relatedForm.father_cast')->label('Caste'),
                                            ]),
                                    ]),
                                Tabs\Tab::make('Mother')
                                    ->schema([
                                        Grid::make(3)
                                            ->schema([
                                                TextEntry::make('relatedForm.n_mother_first_name')->label('Mother\'s First Name (Nepali)'),
                                                TextEntry::make('relatedForm.n_mother_middle_name')->label('Mother\'s Middle Name (Nepali)'),
                                                TextEntry::make('relatedForm.n_mother_last_name')->label('Mother\'s Last Name (Nepali)'),
                                                TextEntry::make('relatedForm.e_mother_first_name')->label('Mother\'s First Name (English)'),
                                                TextEntry::make('relatedForm.e_mother_middle_name')->label('Mother\'s Middle Name (English)'),
                                                TextEntry::make('relatedForm.e_mother_last_name')->label('Mother\'s Last Name (English)'),
                                            ]),
                                        Grid::make(3)
                                            ->schema([
                                                TextEntry::make('relatedForm.mother_province')->label('Province'),
                                                TextEntry::make('relatedForm.mother_municipality')->label('Municipality'),
                                                TextEntry::make('relatedForm.mother_ward')->label('Ward Number'),
                                                TextEntry::make('relatedForm.mother_street')->label('Street'),
                                                TextEntry::make('relatedForm.mother_village')->label('Village'),
                                                TextEntry::make('relatedForm.mother_house_no')->label('House Number'),
                                                TextEntry::make('relatedForm.mother_citizenship_no')->label('Citizenship Number'),
                                                TextEntry::make('relatedForm.mother_dob')->label('Date of Birth'),
                                                TextEntry::make('relatedForm.mother_education')->label('Education'),
                                                TextEntry::make('relatedForm.mother_occupation')->label('Occupation'),
                                                TextEntry::make('relatedForm.mother_religion')->label('Religion'),
                                                TextEntry::make('relatedForm.mother_cast')->label('Caste'),
                                            ]),
                                    ]),
                            ]),
                    ]),

                Section::make('Parent Details')
                    ->description('If the parents are from a foreign country.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('relatedForm.father_passport_no')->label('Father\'s Passport Number'),
                                TextEntry::make('relatedForm.father_country')->label('Father\'s Country'),
                                TextEntry::make('relatedForm.mother_passport_no')->label('Mother\'s Passport Number'),
                                TextEntry::make('relatedForm.mother_country')->label('Mother\'s Country'),
                            ]),
                    ]),

                Section::make('Parent Marriage Details')
                    ->description('Details about the parents\' marriage.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('relatedForm.marriage_registration_no')->label('Marriage Registration Number'),
                                TextEntry::make('relatedForm.marriage_date')->label('Marriage Date'),
                            ]),
                    ]),

                Section::make('Informer Details')
                    ->description('Details of the person providing this information.')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('relatedForm.n_informer_first_name')->label('Informer\'s First Name (Nepali)'),
                                TextEntry::make('relatedForm.n_informer_middle_name')->label('Informer\'s Middle Name (Nepali)'),
                                TextEntry::make('relatedForm.n_informer_last_name')->label('Informer\'s Last Name (Nepali)'),
                                TextEntry::make('relatedForm.e_informer_first_name')->label('Informer\'s First Name (English)'),
                                TextEntry::make('relatedForm.e_informer_middle_name')->label('Informer\'s Middle Name (English)'),
                                TextEntry::make('relatedForm.e_informer_last_name')->label('Informer\'s Last Name (English)'),
                            ]),
                        Grid::make(4)
                            ->schema([
                                TextEntry::make('relatedForm.informer_relation_with_child')->label('Relation with Child'),
                                TextEntry::make('relatedForm.citizenship_number')->label('Citizenship Number'),
                                TextEntry::make('relatedForm.passport_number')->label('Passport Number (if foreigner)'),
                                TextEntry::make('relatedForm.issued_country')->label('Passport Issued Country'),
                            ]),
                    ]),
            ]);
    }
}
