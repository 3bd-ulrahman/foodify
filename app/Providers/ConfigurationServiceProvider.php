<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class ConfigurationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->configureCommands();
        $this->configureModels();
        $this->configureUrl();
        $this->configureValidation();
    }

    private function configureCommands(): void
    {
        DB::prohibitDestructiveCommands(
            app()->isProduction()
        );
    }

    private function configureModels(): void
    {
        Model::shouldBeStrict();
        Model::automaticallyEagerLoadRelationships();
    }

    private function configureUrl(): void
    {
        URL::forceHttps(app()->isProduction());
    }

    private function configureValidation(): void
    {
        FormRequest::failOnUnknownFields();
    }
}
