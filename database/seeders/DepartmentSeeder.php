<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::insert([
            [
                'initial' => 'PPIC',
                'name' => 'Produksi Planning Inventory Control',
            ],
            [
                'initial' => 'FAB',
                'name' => 'Fabrikasi',
            ],
            [
                'initial' => 'KOMP',
                'name' => 'Komponen',
            ],
            [
                'initial' => 'PAINT',
                'name' => 'Painting',
            ],
        ]);
    }
}
