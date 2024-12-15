<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrintLog extends Model
{
    protected $table = 'print_logs';

    protected $fillable = ['certificate_id', 'action_type', 'officer_id'];

    public function serviceCertificate()
    {
        return $this->belongsTo(ServiceCertificate::class, 'certificate_id');
    }
}
