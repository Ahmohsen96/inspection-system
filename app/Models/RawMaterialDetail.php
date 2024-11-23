<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawMaterialDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'raw_material_id',
        'material_name',
        'grade',
        'quantity',
        'status',
        'remarks',
    ];

    public function rawMaterial()
    {
        return $this->belongsTo(RawMaterial::class);
    }
}

