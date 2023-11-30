<?php

namespace App\Traits;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Exceptions\HttpResponseException;

trait GeneralTrait
{


    public function getCurrentLang()
    {
        return app()->getLocale();
    }

    function getLocales()
    {
        $supportedLocales = config('laravellocalization.supportedLocales');

        return array_keys($supportedLocales);
    }

    function getLangs()
    {
        $supportedLocales = config('laravellocalization.supportedLocales');

        return response()->json([
            'locales' => array_keys($supportedLocales),
            'langs' => $supportedLocales
        ]);
    }

    function apiResponse($data = [], $msg = '', $statusCode = 200)
    {
        return response()->json([
            "msg" => $msg,
            "data" => $data
        ], $statusCode);
    }

    public function returnValidationError($validator)
    {
        return $this->apiResponse([], $validator->errors()->first(), 422);
    }

    public function returnFormRequestError($error)
    {
        throw new HttpResponseException(
            response()->json([
                'msg' => $error,
                'data' => [],
            ], 422)
        );
    }

    public function detectRequestPlatform()
    {
        $userAgent = strtolower(request()->header('User-Agent'));

        if (strpos($userAgent, 'android') !== false || strpos($userAgent, 'iphone') !== false || strpos($userAgent, 'ipad') !== false || strpos($userAgent, 'iOS') !== false) {
            return 'mobile';
        } else {
            return 'web';
        }
    }
}
