<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ApiController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs;


    protected $statusCode;
    protected $httpCode;

    public function __construct()
    {
        $this->statusCode = config('staticdata.status_codes');
        $this->httpCode = config('staticdata.http_codes');
    }

    public function formatPaginatedDataResponse($message, $statusCode, $httpCode, $additionalData = [])
    {
        $response = [
        'status_code' => $statusCode,
        ];
        $response = array_merge($response, $message->toArray(), $additionalData );

        return response()->json($response, $httpCode);
    }

    public function formatDataResponse($message, $statusCode, $httpCode)
    {
        $response = [
            'status_code' => $statusCode,
            'data' => $message
        ];

        return response()->json($response, $httpCode);
    }

    public function formatGeneralResponse($message, $statusCode, $httpCode)
    {
        $response = [
            'status_code' => $statusCode,
            'message' => $message
        ];

        return response()->json($response, $httpCode);
    }

    public function formatErrorResponse($data, $statusCode = null, $http_response = null)
    {
        $statusCode = $statusCode ?? config('staticdata.status_codes.error');
        $http_response = $http_response ?? config('staticdata.http_codes.internal_server_error');

        $message = [
            'status_code' => $statusCode,
            'errors' => $data,
        ];

        return response()->json($message, $http_response);
    }
}
