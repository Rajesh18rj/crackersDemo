<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

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
        // This will register Livewire routes under /crackers/livewire/*
        Livewire::setUpdateRoute(function ($handle) {
            return \Illuminate\Support\Facades\Route::post('/crackers/livewire/update', $handle);
        });
    }
}
