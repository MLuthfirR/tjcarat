<?php

namespace App\Http\Controllers\Helpers;

use App\Http\Services\Connections\GatewayConnection;
use Illuminate\Http\Request;

class WebApiHelper
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(GatewayConnection $connection)
    {
        $this->connection = $connection;
    }

    public function general(Request $request) {
        return $this->webApi($request, 'general');
    }

    public function customer(Request $request) {
        return $this->webApi($request, 'customer');
    }

    public function admin(Request $request) {
        return $this->webApi($request, 'admin');
    }

    public function mgmt(Request $request) {
        return $this->webApi($request, 'manager');
    }

    public function sa(Request $request) {
        return $this->webApi($request, 'admin');
    }

    function webApi(Request $request, $user_role) {
        $api_id = $request->input('api');
        $user_role = $user_role;

        if ($this->isApiAvailable($api_id, $user_role)) {
            $input_data = $request->except(['_token', 'api']);
            return CallApiHelper::callApi($this->connection, $api_id, $input_data);
        }

        abort(400, "API path not found");
    }

    function isApiAvailable($api_id, $user_role) {
        if ($api_id && $user_role) {
            $config = config('api.'.$api_id);

            if ($config && isset($config['role']) && $config['role'] == $user_role) {
                return True;
            }
        }

        return False;
    }
}
