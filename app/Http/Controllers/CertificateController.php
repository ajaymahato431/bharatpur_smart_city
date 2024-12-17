<?php

namespace App\Http\Controllers;

use App\Models\BirthCertificateForm;
use Illuminate\Http\Request;
use Spatie\LaravelPdf\Facades\Pdf;

class CertificateController extends Controller
{
    public function birthCertificatePdf($id)
    {
        $certificate = BirthCertificateForm::findOrFail($id);

        // Static officer name (you can fetch dynamically if needed)
        $officerName = "Mr. Ram Bahadur Thapa";

        // Generate PDF
        $pdf = Pdf::view('pdf.birth_certificate', [
            'certificate' => $certificate,
            'officer_name' => $officerName
        ])
            ->format('A4') // A4 size
            ->name('birth-certificate-' . $certificate->id . '.pdf')
            ->download(); // Forces download

        return $pdf;
    }
}
