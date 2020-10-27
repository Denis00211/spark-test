<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\ProductCategoryRequest;
use App\Http\Requests\Products\ProductDestroyRequest;
use App\Http\Requests\Products\ProductIndexRequest;
use App\Http\Requests\Products\ProductShowRequest;
use App\Http\Requests\Products\ProductStoreRequest;
use App\Http\Requests\Products\ProductUpdateRequest;
use App\Http\Resources\Products\ProductIndexResource;
use App\Http\Resources\Products\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Exception;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * @var ProductService
     */
    private $service;

    /**
     * UserController constructor.
     * @param ProductService $service
     */
    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    /**
     * @param ProductIndexRequest $request
     * @return AnonymousResourceCollection
     */
    public function index(ProductIndexRequest $request): AnonymousResourceCollection
    {
        return ProductIndexResource::collection($this->service->index($request->validated()));
    }


    public function category(ProductCategoryRequest $request)
    {
        return ProductIndexResource::collection($this->service->category($request->validated()));
    }
    /**
     * @param ProductStoreRequest $request
     * @return Response
     */
    public function store(ProductStoreRequest $request): Response
    {
        $this->service->store($request->validated());

        return response()->noContent();
    }

    /**
     * @param ProductShowRequest $request
     * @param Product $product
     * @return ProductResource
     */
    public function show(ProductShowRequest $request, Product $product): ProductResource
    {
        return new ProductResource($this->service->show($product));
    }

    /**
     * @param ProductUpdateRequest $request
     * @param Product $product
     * @return Response
     */
    public function update(ProductUpdateRequest $request, Product $product): Response
    {
        $this->service->update($product, $request->validated());

        return response()->noContent();
    }

    /**
     * @param ProductDestroyRequest $request
     * @param Product $product
     * @return Response
     *
     * @throws Exception
     */
    public function destroy(ProductDestroyRequest $request, Product $product): Response
    {
        $this->service->destroy($product);

        return response()->noContent();
    }
}
