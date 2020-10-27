<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\CategoryDestroyRequest;
use App\Http\Requests\Categories\CategoryIndexRequest;
use App\Http\Requests\Categories\CategoryShowRequest;
use App\Http\Requests\Categories\CategoryStoreRequest;
use App\Http\Requests\Categories\CategoryUpdateRequest;
use App\Http\Resources\Categories\CategoryIndexResource;
use App\Http\Resources\Categories\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;
use Exception;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class CategoryController extends Controller
{

    /**
     * @var CategoryService
     */
    private $service;

    /**
     * UserController constructor.
     * @param CategoryService $service
     */
    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    /**
     * @param CategoryIndexRequest $request
     * @return AnonymousResourceCollection
     */
    public function index(CategoryIndexRequest $request): AnonymousResourceCollection
    {
        return CategoryIndexResource::collection($this->service->index($request->validated()));
    }

    /**
     * @param CategoryStoreRequest $request
     * @return Response
     */
    public function store(CategoryStoreRequest $request): Response
    {
        $this->service->store($request->validated());

        return response()->noContent();
    }

    /**
     * @param CategoryShowRequest $request
     * @param Category $category
     * @return CategoryResource
     */
    public function show(CategoryShowRequest $request, Category $category): CategoryResource
    {
        return new CategoryResource($this->service->show($category));
    }

    /**
     * @param CategoryUpdateRequest $request
     * @param Category $category
     * @return Response
     */
    public function update(CategoryUpdateRequest $request, Category $category): Response
    {
        $this->service->update($category, $request->validated());

        return response()->noContent();
    }

    /**
     * @param CategoryDestroyRequest $request
     * @param Category $category
     * @return Response
     *
     * @throws Exception
     */
    public function destroy(CategoryDestroyRequest $request, Category $category): Response
    {
        $this->service->destroy($category);

        return response()->noContent();
    }


}
