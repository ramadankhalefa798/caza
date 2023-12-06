<?php

namespace App\Http\Controllers\Api\User;

use App\Models\User;
use App\Traits\GeneralTrait;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Requests\User\ConfirmCodeRequest;

class AuthController extends Controller
{
    use GeneralTrait;

    public function register(RegisterRequest $request)
    {
        try {
            $user = new User();
            $user->name = $request->name;
            $user->country_code = $request->country_code;
            $user->phone = $request->phone;
            $user->adjective_id = $request->adjective_id;
            $user->photo = 'default.png';
            $user->save();

            if ($user) {
                return $this->apiResponse([], __("user.auth.user_added"), 201);
            } else {
                return $this->apiResponse([], __("user.auth.not_able_to_create_user"), 501);
            }
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), 500);
        }
    }

    public function login(LoginRequest $request)
    {
        $user = User::where(['phone' => $request->phone, 'country_code' => $request->country_code])->first();

        if ($user) {
            $data = [
                "user_id" => $user->id
            ];
            return $this->apiResponse($data, __("user.auth.logged_in"), 200);
        } else {
            return $this->apiResponse([], __("user.auth.user_not_exist"), 404);
        }
    }

    public function confirmCode(ConfirmCodeRequest $request)
    {
        try {
            $user = User::where(['id' => $request->id, 'phone' => $request->phone, 'country_code' => $request->country_code])->first();
            if (!$user) {
                return $this->apiResponse([], __("user.auth.user_not_exist"), 404);
            }

            if (!$user_token = JWTAuth::fromUser($user)) {
                return $this->apiResponse([], "Token dosn\'t generated.", 403);
            }

            $user->verified_at = date('Y-m-d H:i:s');
            $user->save();

            $user['token_type'] = 'Bearer';
            $user['token'] = $user_token;

            $data = [
                "user" => $user
            ];

            return $this->apiResponse($data, __("user.auth.logged_in_successfuly"), 200);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), 500);
        }
    }

    public function logout()
    {
        try {
            auth()->guard('api')->logout();
            return $this->apiResponse([], __("user.auth.logged_out"), 200);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), 500);
        }
    }

    public function me()
    {
        try {
            return $this->apiResponse(auth()->guard('api')->user(), "User data", 200);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), 500);
        }
    }
}
