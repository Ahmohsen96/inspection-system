<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'inspection_form_id',
        'attribute_id',
        'value',
        'result'
    ];

    public function inspectionForm()
    {
        return $this->belongsTo(InspectionForm::class);
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
