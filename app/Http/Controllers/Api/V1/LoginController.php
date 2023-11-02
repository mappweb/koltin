<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Handle a login request to the application.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $validator = $this->requestValidate($request);
        if($validator->fails()){
            return response()->json([
                'message' => 'Validation Error',
                'data' =>  $validator->errors(),
            ], 423);
        }
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }
        $user = Auth::user();

        return response()->json([
            'user' => new UserResource($user),
            'authorization' => [
                'token' => $user->createToken('ApiToken')->plainTextToken,
                'type' => 'bearer',
            ]
        ]);
    }

    /**
     * Validate the user login request.
     *
     * @param Request $request
     * @return \Illuminate\Validation\Validator
     */
    private function requestValidate(Request $request): \Illuminate\Validation\Validator
    {
        return Validator::make($request->all(), [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    private function username(): string
    {
        return 'email';
    }
}
