<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class BirthCertificateForm extends Model
{
    protected $table = 'birth_certificate_forms';

    // Polymorphic Relationship
    public function serviceRequests(): MorphMany
    {
        return $this->morphMany(ServiceRequest::class, 'related_request');
    }
}
