<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function buildFailedValidationResponse(RequestData $request, array $errors)
    {
        return new JsonResponse($errors, 422);  // something like this? if you haven't built your own way to return json responses.
    }
}
