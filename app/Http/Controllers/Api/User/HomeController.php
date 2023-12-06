<?php

namespace App\Http\Controllers\Api\User;

use App\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Deals\DealRequest;
use App\Http\Resources\Deals\DealCollection;
use App\Models\Auction;
use App\Models\Deal;
use App\Models\EstateType;
use App\Models\Profession;

class HomeController extends Controller
{
    use GeneralTrait;

    public function getEstatesTypes()
    {
        try {
            $estates_types = EstateType::active()->select(['id'])
            ->get();

            return $this->apiResponse($estates_types, __('user.estates_types') , 201);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), 500);
        }
    }

    public function getProfessions()
    {
        try {
            $estates_types = Profession::active()->select(['id'])
            ->get();

            return $this->apiResponse($estates_types, __('user.professions') , 201);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), 500);
        }
    }
}
