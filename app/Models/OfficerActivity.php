<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfficerActivity extends Model
{
    protected $table = 'officer_activity';

    protected $fillable = ['officer_id', 'service_request_id', 'action'];

    public function serviceRequest()
    {
        return $this->belongsTo(ServiceRequest::class, 'service_request_id');
    }
}
