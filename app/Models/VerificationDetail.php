<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerificationDetail extends Model
{
    protected $table = 'verification_details';

    protected $fillable = [
        'service_request_id',
        'officer_id',
        'form_no',
        'form_date',
        'family_cost_no',
        'municipality',
        'ward'
    ];

    public function serviceRequest()
    {
        return $this->belongsTo(ServiceRequest::class, 'service_request_id');
    }
}
