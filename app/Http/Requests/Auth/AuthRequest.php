<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;

class AuthRequest extends BaseRequest
{

    public function wantsJson()
    {
        return true;
    }
    protected $forceJsonResponse = true;
    /**
     * @return false
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
            'email' => ['required', 'email'],
            'password' => 'required',
        ];
    }
}
