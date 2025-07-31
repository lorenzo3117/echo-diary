<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Pagination\Paginator;
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
        // https://laravel.com/docs/12.x/eloquent-relationships#custom-polymorphic-types
        Relation::enforceMorphMap([
            'post' => 'App\Models\Post',
            'video' => 'App\Models\Video',
        ]);

        // Pagination styling
        Paginator::defaultView('layout.pagination.pagination');
        Paginator::defaultSimpleView('layout.pagination.pagination-simple');
    }
}
