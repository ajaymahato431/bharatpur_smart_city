<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class BirthCertificateForm extends Model
{
    protected $table = 'birth_certificate_forms';

    // Polymorphic Relationship
    public function serviceRequests(): MorphMany
    {
        return $this->morphMany(ServiceRequest::class, 'related_request');
    }

    public function birthDocuments(): HasOne
    {
        return $this->hasOne(BirthDocument::class, 'birth_certificate_form_id');
    }

    public function verificationDetails(): HasOneThrough
    {
        return $this->hasOneThrough(VerificationDetail::class, ServiceRequest::class);
    }
}
