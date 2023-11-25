<?php
/**
 * Created by PhpStorm.
 * User: Dave
 * Date: 8/19/2018
 * Time: 12:58 PM
 */

namespace App\Services\Recipe;

use App\Constants;
use App\Models\Recipe;
use Illuminate\Support\Facades\Cache;

/**
 * Class RecipeService
 * @recipe App\Services\Recipe
 */
class RecipeService
{
    /**
     * RecipeService constructor.
     * @param Recipe $model
     */
    public function __construct(Recipe $model)
    {
        $this->model = $model;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return Cache::remember('recipe-'.$id, 1, function () use ($id) {
            return $this->model->findOrFail($id);
        });
    }

    /**
     * @param $id
     * @return mixed
     */
    public function forget($id)
    {
        return Cache::forget('recipe-'.$id);
    }

    /**
     * @param array $request
     * @return mixed
     */
    public function create($request = [])
    {
        return $this->model->create(array_only($request, $this->model->getFillable()));
    }

    /***
     * @param Recipe $recipe
     * @param array $request
     * @return Recipe
     */
    public function update(Recipe $recipe, $request = [])
    {
        $recipe->update(array_only($request, $recipe->getFillable()));

        $this->forget($recipe->id);

        return $recipe;
    }


    /**
     * @param Recipe $recipe
     * @return Recipe
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->status = Constants::STATUS_DELETED;

        $recipe->save();

        $this->forget($recipe->id);

        return $recipe;
    }
}