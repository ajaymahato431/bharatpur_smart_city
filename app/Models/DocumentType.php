<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    protected $table = 'document_type';

    protected $fillable = ['document_type'];

    public function documents()
    {
        return $this->hasMany(Document::class, 'document_type_id');
    }
}
