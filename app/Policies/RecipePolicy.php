<?php

namespace App\Policies;

use App\Models\User;
use App\Recipe;
use App\Policies\HasAdmin;
use Illuminate\Auth\Access\HandlesAuthorization;

class RecipePolicy
{
    use HandlesAuthorization;
    use HasAdmin;

    /**
     * Determine whether the user can view the recipe.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Recipe  $recipe
     * @return mixed
     */
    public function view(User $user, Recipe $recipe)
    {
        return true;
    }

    /**
     * Determine whether the user can create recipes.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can update the recipe.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Recipe  $recipe
     * @return mixed
     */
    public function update(User $user, Recipe $recipe)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can delete the recipe.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Recipe  $recipe
     * @return mixed
     */
    public function delete(User $user, Recipe $recipe)
    {
        return $user->is_admin;
    }
}
