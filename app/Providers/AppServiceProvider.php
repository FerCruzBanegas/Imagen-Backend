<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Invoice;
use App\Observers\InvoiceObserver;
use App\Note;
use App\Observers\NoteObserve;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Schema;
// use Illuminate\Database\Eloquent\Builder;

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
        Schema::defaultStringLength(191);
        Collection::macro('paginate', function($perPage, $total = null, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);

            return new LengthAwarePaginator(
                $this->forPage($page, $perPage),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });

        // Builder::macro('withWhereHas', function($relation, $constraint) {
        //     $this->whereHas($relation, $constraint)->with([$relation => $constraint]);
        // });

        Invoice::observe(InvoiceObserver::class);
        Note::observe(NoteObserve::class);
    }
}
