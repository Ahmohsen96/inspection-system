<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialInspectionAttribute extends Model
{
    use HasFactory;

    protected $fillable = ['material_id', 'attribute_id'];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
