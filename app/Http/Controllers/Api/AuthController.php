<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * @param AuthRequest $authRequest
     * @return JsonResponse
     */
    public function login(AuthRequest $authRequest) : JsonResponse
    {
        if (auth()->attempt(['email' => $authRequest->get('email'), 'password' => $authRequest->get('password')])) {
            /**
             * @var $user User
             */
            $user = auth()->user();

            $token = $user->createToken('appToken')->accessToken;

            return response()->json([
                'token' => $token,
            ]);
        } else {
            return response()->json([
                'message' => 'Email or password entered incorrectly',
            ], 401);
        }
    }

    /**
     * @return JsonResponse
     */
    public function logout() : JsonResponse
    {
        /**
         * @var $user User
         */
        $user = auth()->user();
        $token = $user->token();
        $token->revoke();

        return response()->json([
            'success' => true,
            'message' => 'Logout successfully',
        ]);
    }
}
