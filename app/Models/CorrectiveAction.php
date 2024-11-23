<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorrectiveAction extends Model
{
    use HasFactory;

    protected $fillable = [
        'inspection_issue_id',
        'action_description',
        'implemented_by',
        'status',
        'remarks'
    ];

    public function inspectionIssue()
    {
        return $this->belongsTo(InspectionIssue::class);
    }
}
