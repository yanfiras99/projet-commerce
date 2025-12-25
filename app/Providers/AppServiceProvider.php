<?php

namespace App\Providers;

use App\Models\Article;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use App\Policies\ArticlePolicy;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->singleton(\App\Services\FormatagePrixService::class, function ($app) {
            $devise = $app['config']->get('tarification.devise');
            $TVA = (float) $app['config']->get('tarification.TVA');
            return new \App\Services\FormatagePrixService($devise, $TVA);
        });
    }

    /**
     * Bootstrap any application services.
     */

    public function boot(): void
    {
        Paginator::useBootstrapFive();

        Gate::policy(Article::class, ArticlePolicy::class);

        Schema::defaultStringLength(191);

        // pour protéger les routes de connexion et d'inscription aux utilisateurs authentifiés
        // on redirige vers la page d'accueil du shop
        RedirectIfAuthenticated::redirectUsing(function ($request, $guard) {
            return route('shop.index');
        });
    }
}
