<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function passwordAuthentication(Request $request) {
        try {
            $data = [
                'grant_type' => 'password',
                'client_id' => '9556a477-767b-4e8e-b245-4fadb60895a1', // client id
                'client_secret' => 'FptUCpIBdErBWG4YVsfpqNSM5TUcWnrWYExhyPUg', // client secret
                'username' => $request->username,
                'password' => $request->password
            ];
            $httpResponse = app()->handle(
                Request::create('/oauth/token', 'POST', $data)
            );
            $result = json_decode($httpResponse->getContent());
            if ($httpResponse->getStatusCode() !== 200) {
                throw new Exception($result->message);
            }
            return response()->json($result);
        } catch (Exception $ex) {
            return response()->json(
                ['message' => $ex->getMessage()],
                500
            );
        }
    }

    public function me(Request $request)
    {
        try {
            return response()->json([
                'data' => [
                    'type' => 'users',
                    'attributes' => $request->user('api'),
                ],
            ]);
        } catch (Exception $ex) {
            return response()->json(
                ['message' => $ex->getMessage()],
                500
            );
        }
    }

    public function logout(Request $request)
    {
        try {
            return response()->json(
                $request->user('api')
                    ->token()
                    ->revoke()
            );
        } catch (Exception $ex) {
            return response()->json(
                ['message' => $ex->getMessage()],
                500
            );
        }
    }
}
