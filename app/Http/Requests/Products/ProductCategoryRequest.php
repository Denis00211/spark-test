<?php

namespace App\Http\Requests\Products;

use App\Http\Requests\BaseRequest;
use Illuminate\Contracts\Auth\Authenticatable;

class ProductCategoryRequest extends BaseRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return \string[][]
     */
    public function rules()
    {
        return [
            'categoryIds' => ['required', 'array'],
            'categoryIds.*' => ['required', 'integer', 'exists:categories,id'],
        ];
    }
}
