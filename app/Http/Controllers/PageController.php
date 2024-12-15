<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function birthCertificateForm()
    {
        return view('form.birth_certificate_form');
    }
}
