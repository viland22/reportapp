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
        'BLProjectStart',
        'BLProjectFinish',
        'ActualStart',
        'ActualFinish',
        'ActivityStatus',
        'Department',
        'remarks',
        'WoNumber',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'Department', 'id');
    }
}
