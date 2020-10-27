<?php


namespace App\Services;


use App\Models\Category;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CategoryService
{
    /**
     * @param array $input
     * @return Builder[]|Collection
     */
    public function index(array $input)
    {
        $query = Category::query();

        if (isset($input['search'])) {
            $query->where('categories.title' ,'like', "%".$input['search']."%");
        }

        $query->with(['products' => function($query) {
            $query->select(['products.id', 'products.title']);
        }]);

       return $query->get();
    }

    /**
     * @param Category $category
     * @return Category
     */
    public function show(Category $category)
    {
        return $category->load('products');
    }

    /**
     * @param array $input
     * @return Builder|Model
     */
    public function store(array $input)
    {
        $category = Category::query()->create($input);

        if($category->id && isset($input['productIds'])) {
            $category->categoryProducts()->attach($input['productIds']);
        }

        return $category;
    }

    /**
     * @param Category $category
     * @param array $input
     * @return bool
     */
    public function update(Category $category, array $input)
    {
        $categoryIsUpdate = $category->update($input);

        if(isset($input['productIds'])) {
            $category->categoryProducts()->sync($input['productIds']);
        }

        return $categoryIsUpdate;
    }

    /**
     * @param Category $category
     * @return bool|null
     * @throws Exception
     */
    public function destroy(Category $category)
    {
        return $category->delete();
    }
}
