<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function fetchUserByUUID(Request $request)
    {
        $this->validate($request, [
            'uuid' => 'required',
        ]);

        $body = [
            'uuid' => $request->input('uuid'),
        ];

        $user = User::where('uuid', $body['uuid'])->with(['documents'])->first();

        if (!$user) {
            abort(404, "User not found");
        }

        return response()->json([
            'success' => True,
            'message' => 'Data retrieved',
            'data' => $user,
        ], 200);
    }

    public function fetchActiveUsers(Request $request) {
        $customer = User::where("active", true)->get();

        return response()->json([
            'success' => True,
            'message' => 'Data retrieved',
            'data' => [
                'result' => $customer,
                'counts_messages' => $this->getAllCountsCustomers(),
            ],
        ], 200);
    }

    /**
     * Get inactive customer accounts
     *
     * Get all inactive custoemer accounts
     * <aside class="warning">Authorization: <code><b>super-admin</b></code></aside>
     *
     * @responseFile storage/docs/responses/default.json
     */
    public function fetchInactiveUsers(Request $request) {
        $customer = User::where('active', False)->get();

        return response()->json([
            'success' => True,
            'message' => 'Data retrieved',
            'data' => [
                'result' => $customer,
                'counts_messages' => $this->getAllCountsCustomers(),
            ],
        ], 200);
    }

    public function disableAccount(Request $request) {
        $this->validate($request, [
            'uuid' => 'required',
        ]);

        $body = [
            'uuid' => $request->input('uuid'),
        ];

        $user = User::where('uuid', $body['uuid'])->first();
        if (!$user) {
            abort(404, "User not found");
        }

        DB::transaction(function () use ($user) {
            $user->active = False;
            $user->save();
        });

        return response()->json([
            'success' => True,
            'message' => "Account successfully disabled",
            'data' => [],
        ], 200);
    }

    public function activateAccount(Request $request) {
        $this->validate($request, [
            'uuid' => 'required',
        ]);

        $body = [
            'uuid' => $request->input('uuid'),
        ];

        $user = User::where('uuid', $body['uuid'])->first();
        if (!$user) {
            abort(404, "User not found");
        }

        DB::transaction(function () use ($user) {
            $user->active = True;
            $user->save();
        });

        return response()->json([
            'success' => True,
            'message' => "Account successfully activated",
            'data' => [],
        ], 200);
    }

    function getAllCountsCustomers() {
        $counts = [
            'inactive' => User::where('active', False)->count(),
            'customer' => User::where('active', true)->count(),
        ];

        $messages = [];

        return [
            "counts" => $counts,
            "messages" => $messages,
        ];
    }
}
