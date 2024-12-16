<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ServiceRequest extends Model
{
    protected $table = 'service_requests';

    protected $fillable = [
        'user_id',
        'service_id',
        'status',
        'related_request_id',
        'related_request_type',
        'submission_date',
        'verification_date',
        'completion_date'
    ];

    public function documents()
    {
        return $this->hasMany(Document::class, 'service_request_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function verificationDetails()
    {
        return $this->hasOne(VerificationDetail::class, 'service_request_id');
    }

    public function serviceCertificates()
    {
        return $this->hasOne(ServiceCertificate::class, 'service_request_id');
    }

    public function officerActivities()
    {
        return $this->hasMany(OfficerActivity::class, 'service_request_id');
    }

    // Polymorphic Relationship
    public function relatedRequest(): MorphTo
    {
        return $this->morphTo('related_request', 'related_request_type', 'related_request_id');
    }
}
