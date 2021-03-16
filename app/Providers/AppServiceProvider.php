<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        // Builder::mixin(new QueryBuilderMacros());
        //
        // Add whereLike
        // https://murze.be/searching-models-using-a-where-like-query-in-laravel

        Builder::macro('whereLike2', function ($attributes, string $searchTerms) {
            if (! empty($searchTerms)) {
                // \Barryvdh\Debugbar\Facade::info('whereLike Called '.$searchTerms);
                $this->where(function (Builder $query) use ($attributes, $searchTerms) {
                    foreach (Arr::wrap($attributes) as $attribute) {
                        $query->orWhere(function ($subquery) use ($attribute, $searchTerms) {
                            foreach (explode(' ', $searchTerms) as $searchTerm) {
                                $subquery->where($attribute, 'ILIKE', "%{$searchTerm}%");
                            }
                        });
                    }
                });
            }

            return $this;
        });

        Builder::macro('whereLike', function ($attributes, string $searchTerms) {
            if (! empty($searchTerms)) {
                $this->where(function (Builder $query) use ($attributes, $searchTerms) {
                    foreach (Arr::wrap($attributes) as $attribute) {
                        $query->orWhere(function ($query) use ($attribute, $searchTerms) {
                            foreach (explode(' ', $searchTerms) as $searchTerm) {
                                $searchTerm = strtolower($searchTerm);
                                $query->where(DB::raw('LOWER('.$attribute.')'), 'LIKE', "%{$searchTerm}%");
                            }
                        });
                    }
                });
            }

            return $this;
        });
    }
}
