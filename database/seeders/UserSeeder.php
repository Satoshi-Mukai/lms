<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 管理者
        User::create([
            'name' => '管理者',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        // 一般ユーザー
        User::create([
            'name' => 'テスト受講者',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'is_admin' => false,
            'department_id' => 1, // 営業部に所属（DepartmentSeederで先に作成される）
        ]);
    }
}
