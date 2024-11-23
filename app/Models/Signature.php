<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
    use HasFactory;

    protected $fillable = [
        'inspection_form_id',
        'manager_name',
        'manager_signature',
        'manager_signed_at',
        'store_name',
        'store_signature',
        'store_signed_at',
        'quality_inspector_name',
        'quality_inspector_signature',
        'quality_inspector_signed_at',
    ];
}
