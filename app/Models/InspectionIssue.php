<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionIssue extends Model
{
    use HasFactory;

    protected $fillable = [
        'inspection_form_id',
        'description',
        'severity',
        'reported_by'
    ];

    public function inspectionForm()
    {
        return $this->belongsTo(InspectionForm::class);
    }

    public function followUpActions()
    {
        return $this->hasMany(FollowUpAction::class);
    }
}
