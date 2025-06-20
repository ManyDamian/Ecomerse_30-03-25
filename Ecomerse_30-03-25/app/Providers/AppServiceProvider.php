<?php

namespace App\Providers;
use App\Models\Categoria;
use App\Policies\CategoriaPolicy;
use App\Models\Carrito;
use App\Models\Venta;
use App\Models\Producto;
use App\Policies\VentaPolicy;
use App\Policies\CarritoPolicy;
use App\Policies\ProductoPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    protected $policies = [
        Categoria::class => CategoriaPolicy::class,
        Carrito::class => CarritoPolicy::class,
        Venta::class => VentaPolicy::class,
        User::class => UserPolicy::class,
        Producto::class => ProductoPolicy::class,
    ];
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    
}
