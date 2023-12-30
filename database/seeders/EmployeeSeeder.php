<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employees')->insert([
            'nama' => 'Amanda Putri',
            'jeniskelamin' => 'cewe',
            'umur' => '19',
            'notelpon' => '085832586546',
            'alamat' => 'Karangawen',
        ]);
    }
}
