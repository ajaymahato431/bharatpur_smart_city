<?php

namespace App\Http\Controllers;

use App\Models\HeroSection;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function home()
    {
        // Fetch all hero section data
        $heroSections = HeroSection::all();

        // Pass data to the home view
        return view('home', compact('heroSections'));
    }
}
