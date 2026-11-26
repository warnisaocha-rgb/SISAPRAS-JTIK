<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['dashboard.admin', 'dashboard.ruangan', 'dashboard.users'], function ($view) {
            if ($view->offsetExists('pendingPengelolaCount')) {
                return;
            }

            $pendingCount = 0;
            try {
                if (Schema::hasTable('users')) {
                    $pendingCount = User::where('role', 'pengelola')
                        ->where('status_akun', 'menunggu_acc')
                        ->count();
                }
            } catch (\Throwable $e) {
                $pendingCount = 0;
            }

            $view->with('pendingPengelolaCount', $pendingCount);
        });
    }
}
