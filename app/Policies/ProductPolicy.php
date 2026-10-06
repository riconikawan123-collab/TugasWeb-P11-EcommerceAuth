<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'editor', 'user'], true);
    }

    public function view(User $user, Product $product): bool
    {
        return in_array($user->role, ['admin', 'editor', 'user'], true);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'editor'], true);
    }

    public function update(User $user, Product $product): bool
    {
        return in_array($user->role, ['admin', 'editor'], true);
    }

    public function delete(User $user, Product $product): bool
    {
        return $user->role === 'admin';
    }
}