<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfficerDetail extends Model
{
    public function officers()
    {
        return $this->belongsTo(Officer::class, 'officer_id');
    }
}
