<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// routes/web.php

// 誰でも見れるページ（ログイン不要）
Route::get('/', function () {
    return view('welcome');
});
Route::get('/guest', function () {
    return view('guest');
});

// ログイン後共通（プロフィールなど）
// ミドルウェアauthを通してからアクセスさせる
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});

// 管理者専用
// app/http/authserviceproviderで、管理者フラグがあるユーザーかどうかの判断（isAdminという処理名）
Route::middleware(['auth', 'can:isAdmin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('admin.dashboard');
    Route::get('/users', fn() => view('admin.users')); // ユーザー管理
    Route::get('/courses', fn() => view('admin.courses')); // 講座管理


});

// 受講者専用
Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::get('/dashboard', fn() => view('user.dashboard'))->name('user.dashboard');
    Route::get('/courses', fn() => view('user.courses'));
});


require __DIR__.'/auth.php';
