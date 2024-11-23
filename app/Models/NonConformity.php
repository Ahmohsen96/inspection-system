<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonConformity extends Model
{
    use HasFactory;

    protected $fillable = [
        'raw_material_id', 'non_conformity_type', 'description', 'status',
    ];

    public function rawMaterial()
    {
        return $this->belongsTo(RawMaterial::class);
    }
}
