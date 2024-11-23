<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowUpAction extends Model
{
    use HasFactory;

    protected $fillable = [
        'inspection_issue_id',
        'action_description',
        'assigned_to',
        'status',
        'remarks'
    ];

    public function inspectionIssue()
    {
        return $this->belongsTo(InspectionIssue::class);
    }
}
