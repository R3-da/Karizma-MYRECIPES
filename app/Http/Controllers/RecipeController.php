<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Http\Resources\RecipeResource;
use App\Http\Requests\RecipeRequest as Request;
use App\Exceptions\SubscriptionException;
use App\Services\Activity\ActivityService;
use App\Services\Recipe\RecipeCollection;
use App\Services\Recipe\RecipeService;

class RecipeController extends Controller
{
    /**
     * Pagination per_page.
     *
     * @var integer
     */
    public $per_page = 30;

    /**
     * @var RecipeService
     */
    protected $service;

    /**
     * RecipeController constructor.
     * @param RecipeService $service
     */
    public function __construct(RecipeService $service)
    {
        $this->service = $service;
    }

    /**
     * @param RecipeCollection $recipes
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(RecipeCollection $recipes)
    {
        $this->authorize('create', Recipe::class);

        $collection = RecipeResource::collection($recipes->get());

        $collection->additional(['meta' => $recipes->meta]);

        return $collection;
    }

    /**
     * @param Request $request
     * @return RecipeResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request)
    {
        $this->authorize('create', Recipe::class);

        $model = $this->service->create([
            'duration'      => $request->get('duration'),
            'user_id'    => $request->get('user_id'),
            'name'        => $request->get('name'),
            'ingredients'        => $request->get('ingredients'),
            'instructions'        => $request->get('instructions'),
        ]);

        ActivityService::log($model->id, "Recipe #$model->id was created.");

        return new RecipeResource($model);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($id)
    {
        $model = $this->service->find($id);

        $model->load('user');

        $this->authorize('view', $model);

        return new RecipeResource($model);;
    }


    /**
     * @param Request $request
     * @param $id
     * @return RecipeResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, $id)
    {
        $model = $this->service->find($id);

        $this->authorize('update', $model);

        $this->service->update($model, $request->all());

        ActivityService::log($model->id, "Recipe #$model->id was updated.");

        return new RecipeResource($model);
    }

    /**
     * @param $id
     * @return RecipeResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($id)
    {
        $model = $this->service->find($id);

        $this->authorize('delete', $model);

        $this->service->destroy($model);

        ActivityService::log($model->id, "Recipe #$model->id was deleted.");

        return new RecipeResource($model);
    }
}
