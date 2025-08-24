<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'departments';
    protected $fillable = [
        'initial',
        'name',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function activity()
    {
        return $this->hasMany(Activity::class, 'department_id', 'id');
    }
}
