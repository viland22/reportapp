<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'activity';

    protected $fillable = [
        'ActivityId',
        'ActivityName',
        'BLDuration',
        'ActualDuration',
        'Holiday',
        'BLProjectStart',
        'BLProjectFinish',
        'ActualStart',
        'ActualFinish',
        'ActivityStatus',
        'department_id',
        'wo_number_id',
        'Remarks',
    ];

    protected $appends = ['ActivityStatusName'];

    public function getActivityStatusNameAttribute()
    {
        return match($this->ActivityStatus) {
            0 => 'Not Started',
            1 => 'In Progress',
            2 => 'Completed',
            default => 'Unknown',
        };
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
    public function wo_number()
    {
        return $this->belongsTo(Wo_Number::class, 'wo_number_id', 'id');
    }
}
