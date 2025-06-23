<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithValidation;

class UsersImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use SkipsFailures;

    public function model(array $row)
    {
        $department = Department::where('name', $row['department'])->first();

        if (!$department) {
            throw new \Exception("部署 '{$row['department']}' が存在しません。");
        }

        return new User([
            'name' => $row['name'],
            'email' => $row['email'],
            'department_id' => $department->id,
            'password' => Hash::make('password123'),
        ]);
    }

    public function rules(): array
    {
        return [
            '*.name' => ['required', 'string'],
            '*.email' => ['required', 'email', 'unique:users,email'],
            '*.department' => ['required', 'string'],
        ];
    }
}