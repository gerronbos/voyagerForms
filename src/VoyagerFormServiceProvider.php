<?php

namespace Hostingprecisie\VoyagerForm;

use Hostingprecisie\VoyagerForm\Models\Form;
use Hostingprecisie\VoyagerForm\Policies\FormPolicy;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Gate;

class VoyagerFormServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__."/routes/route.php");
        $this->loadViewsFrom(__DIR__."/Views","voyagerForm");
        $this->loadMigrationsFrom(__DIR__."/Migrations");

        $this->publishes([__DIR__."/Views" => resource_path("views/vendor/voyager/")]);

        Gate::policy(Form::class, FormPolicy::class);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
