<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Venta;

class VentaPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->role === 'gerente';
    }
    
    public function view(User $user, Venta $venta): bool
    {
        return $user->role === 'gerente' || $user->id === $venta->user_id;
    }
    
    public function create(User $user): bool
    {
        return $user->role === 'cliente';
    }
    
    public function update(User $user, Venta $venta): bool
    {
        return $user->role === 'gerente';
    }
    public function validar(User $user, Venta $venta)
{
    return $user->role === 'gerente'; // o como manejes roles
}
    public function validateVenta(User $user, Venta $venta): bool
    {
        return $user->role === 'gerente';
    }
    
    public function delete(User $user, Venta $venta): bool
    {
        return $user->role === 'gerente';
    }
    
}
