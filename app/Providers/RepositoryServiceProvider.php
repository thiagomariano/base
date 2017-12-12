<?php

namespace App\Providers;

use App\Repositories\DespesasImportadasRepository;
use App\Repositories\DespesasImportadasRepositoryEloquent;
use App\Repositories\DespesasRepository;
use App\Repositories\DespesasRepositoryEloquent;
use App\Repositories\ImportacoesRepository;
use App\Repositories\ImportacoesRepositoryEloquent;
use App\Repositories\LimitesDespesasRepository;
use App\Repositories\LimitesDespesasRepositoryEloquent;
use App\Repositories\RegrasGeraisRepository;
use App\Repositories\RegrasGeraisRepositoryEloquent;
use App\Repositories\RoleRepository;
use App\Repositories\RoleRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(DespesasRepository::class, DespesasRepositoryEloquent::class);
        $this->app->bind(RegrasGeraisRepository::class, RegrasGeraisRepositoryEloquent::class);
        $this->app->bind(LimitesDespesasRepository::class, LimitesDespesasRepositoryEloquent::class);
        $this->app->bind(RoleRepository::class, RoleRepositoryEloquent::class);
        $this->app->bind(ImportacoesRepository::class, ImportacoesRepositoryEloquent::class);
        $this->app->bind(DespesasImportadasRepository::class, DespesasImportadasRepositoryEloquent::class);
        //:end-bindings:
    }
}
