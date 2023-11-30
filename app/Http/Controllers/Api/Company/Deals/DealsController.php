<?php

namespace App\Http\Controllers\Api\Company\Deals;

use App\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Deals\DealRequest;
use App\Http\Resources\Deals\DealCollection;
use App\Models\Deal;

class DealsController extends Controller
{
    use GeneralTrait;

    private $company = null;

    public function __construct()
    {
        $this->company = auth()->guard('company')->user();
    }

    public function create(DealRequest $request)
    {
        try {
            $deal = new Deal();
            $deal->company_id = $this->company->id;
            $deal->country_id = $request->country_id;
            $deal->deal_type_id = $request->deal_type_id;
            $deal->estate_type_id = $request->estate_type_id;
            $deal->from_us = $request->from_us;
            $deal->deal_value = $request->deal_value;
            $deal->save();

            if ($deal) {
                return $this->apiResponse([], "Deal added successfully", 201);
            } else {
                return $this->apiResponse([], "Not able to create a Deal", 501);
            }
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), 500);
        }
    }

    public function getCompanyDeals()
    {
        try {
            $deals = new DealCollection(Deal::with(['country', 'estateType', 'dealType'])
                ->paginate(PAGINATION_COUNT));

            return $this->apiResponse($deals, "Company deals", 201);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), 500);
        }
    }
}
