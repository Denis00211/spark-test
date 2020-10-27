<?php

namespace App\Http\Requests\Products;

use App\Http\Requests\BaseRequest;
use Illuminate\Contracts\Auth\Authenticatable;

class ProductStoreRequest extends BaseRequest
{
    /**
     * @return Authenticatable|null
     */
    public function authorize()
    {
        return auth()->user();
    }

    public function rules()
    {
        return [
            'title' => ['required', 'string'],
            'categoryIds' => ['array'],
            'categoryIds.*' => ['required', 'integer', 'exists:categories,id'],
        ];
    }
}
