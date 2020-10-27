<?php

namespace App\Http\Requests\Products;

use App\Http\Requests\BaseRequest;

class ProductIndexRequest extends BaseRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'search' => $this->query('search'),
        ]);
    }

    /**
     * @return \string[][]
     */
    public function rules()
    {
        return [
            'search' => ['nullable', 'string'],
        ];
    }
}
