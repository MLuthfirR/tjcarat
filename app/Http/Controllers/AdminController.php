<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $user = json_decode(session()->get('user_data'));
        return view('admin.pages.user.customer.customer', compact('user'));
    }
}
