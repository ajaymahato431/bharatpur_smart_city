<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    protected $fillable = ['name', 'description', 'required_documents', 'process', 'featured_image'];

    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequest::class, 'service_id');
    }
}
