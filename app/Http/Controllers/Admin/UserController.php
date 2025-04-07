<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('is_admin', false)->get();
        // 管理者フラグがないユーザー一覧を取得（get）し、$usersへ格納
        // User::で、モデルクラス（App\Models\user）を呼び出す。
        // つまり、（Eloquent ORMの）Usersモデルを通じて、usersテーブルに対し、
        // whereメソッドで、指定した条件にあうレコードを探しに行き、その一覧を全件getメソッドで取得

        return view('admin.users.index', compact('users'));
        // compact('users')の部分、テキストでは['users' => $users]という書き方だが、同じ意味
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $departments = Department::all();

        return view('admin.users.edit', compact('user', 'departments'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'department_id' => 'nullable|exists:departments,id',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->only(['name', 'email', 'department_id']));

        return redirect()->route('admin.users')->with('success', 'ユーザー情報を更新しました。');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.users')->with('success', 'ユーザーを削除しました。');
    }

    public function create()
    {
        $departments = Department::all(); // 部署一覧をセレクトボックス用に取得
        return view('admin.users.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'department_id' => 'nullable|exists:departments,id',
        ]);

        \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'is_admin' => false,
            'department_id' => $request->department_id,
        ]);

        return redirect()->route('admin.users')->with('success', 'ユーザーを登録しました');
    }

}
