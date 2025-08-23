<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wo_Number extends Model
{
    use HasFactory;
    protected $table = 'wo_numbers';
    protected $fillable = ['wo_number'];
    public function activity()
    {
        return $this->hasMany(Activity::class, 'wo_number_id', 'id');
    }
}
