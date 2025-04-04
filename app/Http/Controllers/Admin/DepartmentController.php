<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('admin.departments.index', compact('departments'));
    }
    public function create()
    {
        return view('admin.departments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Department::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.departments')->with('success', '部署を追加しました');
    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return view('admin.departments.edit', compact('department'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $department = Department::findOrFail($id);
        $department->update(['name' => $request->name]);

        return redirect()->route('admin.departments')->with('success', '部署情報を更新しました');
    }

    public function destroy($id)
    {
        Department::destroy($id);
        return redirect()->route('admin.departments')->with('success', '部署を削除しました');
    }

}
