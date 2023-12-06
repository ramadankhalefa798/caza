<?php

namespace App\Http\Controllers\Api\Company;

use App\Traits\GeneralTrait;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Company\LoginRequest;
use App\Http\Requests\Company\RegisterRequest;
use App\Http\Requests\Company\ConfirmCodeRequest;
use App\Models\Company;

class AuthController extends Controller
{
    use GeneralTrait;

    public function register(RegisterRequest $request)
    {
        try {
            $company = new Company();
            $company->name = $request->name;
            $company->country_code = $request->country_code;
            $company->phone = $request->phone;
            $company->adjective_id = $request->adjective_id;
            $company->photo = 'default.png';
            $company->save();

            if ($company) {
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
        $company = Company::where(['phone' => $request->phone, 'country_code' => $request->country_code])->first();

        if ($company) {
            $data = [
                "company_id" => $company->id
            ];
            return $this->apiResponse($data, __("user.auth.logged_in"), 200);
        } else {
            return $this->apiResponse([], __("user.auth.user_not_exist"), 404);
        }
    }

    public function confirmCode(ConfirmCodeRequest $request)
    {
        try {
            $company = Company::where(['id' => $request->id, 'phone' => $request->phone, 'country_code' => $request->country_code])->first();
            if (!$company) {
                return $this->apiResponse([], __("user.auth.user_not_exist"), 404);
            }

            if (!$company_token = JWTAuth::fromUser($company)) {
                return $this->apiResponse([], "Token dosn\'t generated.", 403);
            }

            $company->verified_at = date('Y-m-d H:i:s');
            $company->save();

            $company['token_type'] = 'Bearer';
            $company['token'] = $company_token;

            $data = [
                "company" => $company
            ];

            return $this->apiResponse($data, __("user.auth.logged_in_successfuly"), 200);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), 500);
        }
    }

    public function logout()
    {
        try {
            auth()->guard('company')->logout();
            return $this->apiResponse([], __("user.auth.logged_out"), 200);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), 500);
        }
    }

    public function me()
    {
        try {
            return $this->apiResponse(auth()->guard('company')->user(), "Company data", 200);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), 500);
        }
    }
}
