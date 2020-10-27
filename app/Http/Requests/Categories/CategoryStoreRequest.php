<?php

namespace App\Http\Requests\Categories;

use App\Http\Requests\BaseRequest;
use Illuminate\Contracts\Auth\Authenticatable;

class CategoryStoreRequest extends BaseRequest
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
            'productIds' => ['array'],
            'productIds.*' => ['required', 'integer', 'exists:products,id'],
        ];
    }
}
