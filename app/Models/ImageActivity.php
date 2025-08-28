<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImageActivity extends Model
{
    use HasFactory;

    protected $table = 'imageactivity';
    protected $fillable = [
        'Activity_Id',
        'Filename',
    ];
}
