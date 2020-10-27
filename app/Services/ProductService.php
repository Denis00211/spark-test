<?php


namespace App\Services;


use App\Models\Product;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ProductService
{
    /**
     * @param array $input
     * @return Builder[]|Collection
     */
    public function index(array $input)
    {
        $query = Product::query();

        if (isset($input['search'])) {
            $query->where('products.title' ,'like', "%".$input['search']."%");
        }

        $query->with(['categories' => function($query) {
            $query->select(['categories.id', 'categories.title']);
        }]);

        return $query->get();
    }

    /**
     * @param Product $product
     * @return Product
     */
    public function show(Product $product)
    {
        return $product->load('categories');
    }

    /**
     * @param array $input
     * @return Builder|Model
     */
    public function store(array $input)
    {
        $product = Product::query()->create($input);

        if($product->id && isset($input['categoryIds'])) {
            $product->productCategories()->attach($input['categoryIds']);
        }

        return  $product;
    }

    /**
     * @param Product $product
     * @param array $input
     * @return bool
     */
    public function update(Product $product, array $input)
    {
        $productIsUpdate = $product->update($input);

        if(isset($input['categoryIds'])) {
            $product->productCategories()->sync($input['categoryIds']);
        }

        return $productIsUpdate;
    }

    /**
     * @param Product $product
     * @return bool|null
     * @throws Exception
     */
    public function destroy(Product $product)
    {
        return $product->delete();
    }

    public function category(array $input)
    {
        $query = Product::query()
            ->select(['products.id', 'products.title'])
            ->leftJoin('categories_products', 'products.id', '=', 'categories_products.product_id')
            ->leftJoin('categories', 'categories.id', '=', 'categories_products.category_id')
            ->whereIn('categories.id', $input['categoryIds']);

        $query->with(['categories' => function($query) {
            $query->select(['categories.id', 'categories.title']);
        }]);

        return $query->get();
    }
}
