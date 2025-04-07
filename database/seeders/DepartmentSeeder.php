<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;


class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Department::create(['name' => '営業部']);
        \App\Models\Department::create(['name' => '総務部']);
        \App\Models\Department::create(['name' => '開発部']);
    }
}
