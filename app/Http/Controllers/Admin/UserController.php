<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

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
}
