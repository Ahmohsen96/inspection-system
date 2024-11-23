<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionForm extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     // 'material_id',
    //     // 'inspection_type_id',
    //     // 'date',
    //     // 'remarks',
    //     // 'created_by'


    // ];

    protected $fillable = [
        'inspection_type_id', 'material_name', 'material_size', 'length_tolerance',
        'width_tolerance', 'thickness_tolerance', 'non_conformities',
        'manager_name', 'manager_signature', 'manager_signed_at',
        'store_name', 'store_signature', 'store_signed_at',
        'quality_inspector_name', 'quality_inspector_signature', 'quality_inspector_signed_at',
    ];


    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function inspectionType()
    {
        return $this->belongsTo(InspectionType::class);
    }

    public function inspectionResults()
    {
        return $this->hasMany(InspectionResult::class);
    }

    public function inspectionIssues()
    {
        return $this->hasMany(InspectionIssue::class);
    }
}
