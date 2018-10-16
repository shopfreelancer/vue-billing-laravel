<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;


class Auth2Controller extends Controller
{

    public function login(Request $request)
    {
        $client = new Client([
            'base_uri' => env('APP_URL'),
        ]);

        try {
            $response = $client->post('oauth/token', [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => 2,
                    'client_secret' => env('PASSPORT_CLIENT2_SECRET'),
                    'scope' => '*',
                    'username' => $request->email,
                    'password' => $request->password
                ]
            ]);

            $responseBody = $response->getBody();
            $body = json_decode($responseBody->getContents());
            return response()->json(['token' => $body->access_token],200);

        } catch (RequestException $e) {

            if ($e->hasResponse()) {
                $statusCode = (int)$e->getResponse()->getStatusCode();

                if ($statusCode === 401) {
                    $responseBody = $e->getResponse()->getBody();
                    $body = json_decode($responseBody->getContents());
                    $json = ['success' => false, 'message' => $body->message];
                } else {
                    $json = ['success' => false, 'message' => 'An error occurred.'];
                }

            } else {
                $json = ['success' => false, 'message' => 'An error occurred.'];
            }

            return response()->json($json, 401);
        }

    }

    public function logout(Request $request)
    {
        $accessToken = Auth::user()->token();

        DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->delete();

        $accessToken->delete();

        return response()->json(null, 204);
    }
}
