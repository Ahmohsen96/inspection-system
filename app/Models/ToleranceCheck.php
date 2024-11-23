<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToleranceCheck extends Model
{
    use HasFactory;

    protected $fillable = [
        'raw_material_id',
        'check_type',
        'length_tolerance',
        'width_tolerance',
        'thickness_tolerance',
        'inspection_form_id',
        'deformation',
        'damage',
        'remarks',
    ];
}
