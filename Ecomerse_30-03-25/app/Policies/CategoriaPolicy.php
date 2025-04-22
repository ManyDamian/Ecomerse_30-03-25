<?php

namespace App\Policies;

use App\Models\Categoria;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CategoriaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
{
    return $user->role === 'gerente';
}

public function view(User $user, Categoria $categoria): bool
{
    return $user->role === 'gerente';
}

public function create(User $user): bool
{
    return $user->role === 'gerente';
}

public function update(User $user, Categoria $categoria): bool
{
    return $user->role === 'gerente';
}

public function delete(User $user, Categoria $categoria): bool
{
    return $user->role === 'gerente';
}

}
