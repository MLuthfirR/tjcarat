<?php

namespace App\Http\Controllers\Helpers;

class CallApiHelper
{

    public static function callApi($connection, $config, $data = [], $content = 'json', $should_refresh_token=true) {
        $response_data = json_decode($connection->callApi($config, $data, $content));
        // dd($response_data);
        if (is_object($response_data) && isset($response_data->success)) {
            if ($response_data->success) {
                return response()->json(isset($response_data->data) ? $response_data->data : '', 200);
            } else {
                if ($response_data->code == 401) {
                    if ($should_refresh_token) {
                        $user_token = session()->get('user_token') ? json_decode(session()->get('user_token'), true) : [];
                        if (isset($user_token['refresh_token'])) {
                            return CallApiHelper::refreshToken($connection, $config, $data, $content);
                        }
                    } else {
                        session()->forget('user_data');
                        session()->forget('user_token');
                        session()->flash('danger', "You are unauthenticated. Please re-login.");
                        abort(401, isset($response_data->message) ? $response_data->message : '');
                    }
                } else if ($response_data->code == 403) {
                    abort(404, "Request not found");
                }
                abort($response_data->code ?: 400, isset($response_data->message) ? $response_data->message : '');
            }
        }

        abort(500, 'There is an error on connecting to the server. Please try again or contact us if the problem persists.');
    }

    public static function refreshToken($connection, $config, $data = [], $content = 'json') {
        $user_token = session()->get('user_token') ? json_decode(session()->get('user_token'), true) : [];

        $refresh_token_data = [
            'grant_type' => 'refresh_token',
            'refresh_token' => isset($user_token['refresh_token']) ? $user_token['refresh_token'] : '',
            'client_id' => config('connection.IPC_BE_CLIENT_ID'),
            'client_secret' => config('connection.IPC_BE_CLIENT_SECRET'),
            'scope' => '',
        ];

        $response_data = json_decode($connection->callApi('refreshToken', $refresh_token_data, 'json'), true);
        if (isset($response_data) && isset($response_data['token_type']) && $response_data['token_type'] == 'Bearer') {
            session()->put('user_token', json_encode($response_data));
            return CallApiHelper::callApi($connection, $config, $data, $content, false);
        } else {
            session()->forget('user_data');
            session()->forget('user_token');
            session()->flash('danger', "You are unauthenticated. Please re-login.");
            abort(401, isset($response_data->message) ? $response_data->message : '');
        }
    }

    public static function fetchCallApi($connection, $config, $data = [], $content = 'json') {
        $response_data = json_decode($connection->callApi($config, $data, $content));

        if (is_object($response_data) && isset($response_data->success)) {
            return $response_data;
        }

        return (object)[
            "success" => false,
            "code" => 500,
            "message" => 'There is an error on connecting to the server. Please try again or contact us if the problem persists.',
        ];
    }

    public static function callApiFetchSelect2($connection, $config, $data = []) {
        $response_data = json_decode($connection->callApi($config, $data));

        if (is_object($response_data) && isset($response_data->success) && $response_data->success) {
            return response()->json(["results" => $response_data->data]);
        } else {
            return response()->json(["results" => []]);
        }
    }

}
