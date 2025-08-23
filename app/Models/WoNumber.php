<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WoNumber extends Model
{
    use HasFactory;
    protected $table = 'wonumbers';
    public function activity()
    {
        return $this->hasMany(Activity::class, 'WoNumber', 'id');
    }
}
