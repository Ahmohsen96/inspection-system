<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawMaterial extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_name',
        'po_no',
        'po_date',
        'invoice_number',
        'received_date',
        'ordered_by',
        'brand_name',
        'inspection_type',
        'po_quantity',
        'remarks',
    ];

    public function materials()
{
    return $this->hasMany(RawMaterialDetail::class);
}

public function nonConformities()
{
    return $this->hasMany(NonConformity::class);
}

}
