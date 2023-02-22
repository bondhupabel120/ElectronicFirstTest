<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DB;

class LoginController extends Controller
{
    public function index()
    {
        $users = User::select(
            'users.*',
            DB::raw('(select ip_address from logins where user_id = users.id order by created_at desc limit 1) as ip_address'),
            DB::raw('(select created_at from logins where user_id = users.id order by created_at desc limit 1) as time')
        )
            ->orderBy('users.name')
            ->paginate(10);

        return view('logins', compact('users'));
    }
}
