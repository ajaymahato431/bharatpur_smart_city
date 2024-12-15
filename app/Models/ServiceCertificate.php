<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceCertificate extends Model
{
    protected $table = 'service_certificates';

    protected $fillable = [
        'service_request_id',
        'certificate_path',
        'print_count',
        'certificate_number'
    ];

    public function serviceRequest()
    {
        return $this->belongsTo(ServiceRequest::class, 'service_request_id');
    }

    public function printLogs()
    {
        return $this->hasMany(PrintLog::class, 'certificate_id');
    }
}
