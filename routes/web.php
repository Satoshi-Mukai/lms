<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DepartmentController;

use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\User\CourseController as UserCourseController;

use App\Http\Controllers\Admin\TestSetController;
use App\Http\Controllers\User\TestController;
use App\Http\Controllers\LandingController;

// routes/web.php

// 誰でも見れるページ（ログイン不要）

// トップページにindex.blade.phpの内容が表示されなくなったので、Controllerを使う形に修正を検証。そのためコメントアウト
Route::get('/', function () {
//   return view('a');
    return view('index');    
});

// // 明示的にコントローラーを使用して、トップページ表示する
// Route::get('/', [LandingController::class, 'index'])->name('landing');

// Route::get('/admin/login', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('admin.login');
// Route::get('/user/login', [\App\Http\Controllers\User\Auth\LoginController::class, 'showLoginForm'])->name('user.login');




//Route::get('/', function () {
//    return view('welcome');
//});

// Route::get('/guest', function () {
//     return view('guest');
// });

// ミドルウェアを通したら、表示された
// Route::middleware(['auth'])->get('/', function () {
//     return view('index');
// });

// ログイン後共通（プロフィールなど）
// ミドルウェアauthを通してからアクセスさせる
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});


// 管理者専用
// app/http/authserviceproviderで、管理者フラグがあるユーザーかどうかの判断（isAdminという処理名）
Route::middleware(['auth', 'can:isAdmin'])->prefix('admin')->group(function () {    

    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('admin.dashboard'); // アロー関数で短縮表記　fn() =>
    //Route::get('/courses', fn() => view('admin.courses')); // 講座管理
    Route::get('/departments', [DepartmentController::class, 'index'])->name('admin.departments');
    Route::get('/departments/create', [DepartmentController::class, 'create'])->name('admin.departments.create');
    Route::post('/departments', [DepartmentController::class, 'store'])->name('admin.departments.store');
    Route::get('/departments/{id}/edit', [DepartmentController::class, 'edit'])->name('admin.departments.edit');
    Route::put('/departments/{id}', [DepartmentController::class, 'update'])->name('admin.departments.update');
    Route::delete('/departments/{id}', [DepartmentController::class, 'destroy'])->name('admin.departments.destroy');

    //ユーザー関連
    Route::get('/users', [UserController::class, 'index'])->name('admin.users');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');

    //教材管理
    Route::resource('courses', AdminCourseController::class)->names('admin.courses');

    //テスト関連
    Route::get('/test_sets', [TestSetController::class, 'index'])->name('admin.test_sets.index');
    Route::get('/test_sets/create', [TestSetController::class, 'create'])->name('admin.test_sets.create');
    Route::post('/test_sets', [TestSetController::class, 'store'])->name('admin.test_sets.store');
    Route::get('/test_sets/{id}/edit', [TestSetController::class, 'edit'])->name('admin.test_sets.edit');
    Route::put('/test_sets/{id}', [TestSetController::class, 'update'])->name('admin.test_sets.update');

});



// 受講者専用
Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::get('/dashboard', fn() => view('user.dashboard'))->name('user.dashboard');
    //Route::get('/courses', fn() => view('user.courses'));

    Route::get('/courses', [UserCourseController::class, 'index'])->name('user.courses.index');
    Route::get('/courses/{course}', [UserCourseController::class, 'show'])->name('user.courses.show');

    //PDFを非公開にする
    Route::get('/courses/{course}/pdf', [UserCourseController::class, 'downloadPdf'])->middleware('auth')->name('user.courses.pdf');

    Route::get('/tests', [TestController::class, 'index'])->name('user.tests.index');
    Route::get('/tests/{test_set}', [TestController::class, 'show'])->name('user.tests.show');
    Route::post('/tests/{test_set}/submit', [TestController::class, 'submit'])->name('user.tests.submit');

});


require __DIR__.'/auth.php';
