<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    protected $transformer = null;

    protected function respond($data, $statusCode = 200, $headers = [])
    {
        return response()->json($data, $statusCode, $headers);
    }

    protected function respondCreated($data = null)
    {
        return $this->respond([
            'data' => $data,
            'message' => message('MSG001')
        ], 201);
    }

    protected function respondUpdated($data = null)
    {
        return $this->respond([
            'data' => $data,
            'message' => message('MSG002')
        ]);
    }

    protected function respondDeleted($data = null)
    {
        return $this->respond([
            'data' => $data,
            'message' => message('MSG003')
        ]);
    }

    protected function respondAnuled($data = null)
    {
        return $this->respond([
            'data' => $data,
            'success' => false,
            'message' => message('MSG013')
        ]);
    }

    protected function respondNoContent()
    {
        return $this->respond(null, 204);
    }

    protected function respondError($message, $statusCode)
    {
        return $this->respond([
            'errors' => [
                'message' => $message,
                'status_code' => $statusCode
            ]
        ], $statusCode);
    }

    protected function respondUnauthorized($message = 'Unauthorized')
    {
        return $this->respondError($message, 401);
    }

    protected function respondForbidden($message = 'Forbidden')
    {
        return $this->respondError($message, 403);
    }

    protected function respondNotFound($message = 'Not Found')
    {
        return $this->respondError($message, 404);
    }

    protected function respondFailedLogin()
    {
        return $this->respond([
            'errors' => [
                'email or password' => 'is invalid',
            ]
        ], 422);
    }

    protected function respondInternalError()
    {
        return $this->respondError(message('MSG012'), 500);
    }
}
