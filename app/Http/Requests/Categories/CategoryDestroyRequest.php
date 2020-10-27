<?php

namespace App\Http\Requests\Categories;

use App\Http\Requests\BaseRequest;
use Illuminate\Contracts\Auth\Authenticatable;

class CategoryDestroyRequest extends BaseRequest
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
            'id' => $this->route('category')->id,
        ]);
    }

    /**
     * @return \string[][]
     */
    public function rules()
    {
        return [
            'id' => ['required', 'integer', 'exists:categories,id'],
        ];
    }
}
