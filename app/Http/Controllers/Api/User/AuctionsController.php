<?php

namespace App\Http\Controllers\Api\User;

use App\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Deals\DealRequest;
use App\Http\Resources\Deals\DealCollection;
use App\Models\Auction;
use App\Models\Deal;

class AuctionsController extends Controller
{
    use GeneralTrait;

    private $user = null;

    public function getAuthUser()
    {
        $this->user = auth()->guard('api')->user();
    }

    public function create(DealRequest $request)
    {
        try {
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), 500);
        }
    }

    public function getAuctions()
    {
        try {
            $auctions = Auction::all();
            // $deals = new DealCollection(Deal::with(['country', 'estateType', 'dealType'])
            //     ->paginate(PAGINATION_COUNT));

            return $this->apiResponse($auctions, "Auctions", 201);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), 500);
        }
    }
}
