<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * ポリシーのマッピング
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * 全認可サービスの登録
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // 管理者判定の Gate を追加
        Gate::define('isAdmin', function (User $user) {
            return $user->is_admin;
        });
    }
}
