<?php

namespace App\Http\Requests\Products;

use App\Http\Requests\BaseRequest;
use Illuminate\Contracts\Auth\Authenticatable;

class ProductUpdateRequest extends BaseRequest
{
    /**
     * @return Authenticatable|null
     */
    public function authorize()
    {
        return auth()->user();
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('product')->id,
        ]);
    }

    public function rules()
    {
        return [
            'id' => ['required', 'integer', 'exists:products,id'],
            'title' => ['required', 'string'],
            'categoryIds' => ['array'],
            'categoryIds.*' => ['required', 'integer', 'exists:categories,id'],
        ];
    }
}
