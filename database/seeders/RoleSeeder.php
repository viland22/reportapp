<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::updateOrInsert(['name' => 'admin']);
        Role::updateOrInsert(['name' => 'user']);
        Role::updateOrInsert(['name' => 'ppic']);
        Role::updateOrInsert(['name' => 'produksi']);
    }
}
