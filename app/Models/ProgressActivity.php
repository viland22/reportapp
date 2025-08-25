<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgressActivity extends Model
{
    use HasFactory;

    protected $table = 'progressactivity';
    protected $fillable = [
        'Activity_Id',
        'ProgressDate',
        'ProgressPercent',
        'ProgressNote',
    ];
}
