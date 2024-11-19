<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        $users = User::where('role',0)->get();

        return view('admin.index',
        ['users' => $users]
    );
    }

    public function users() {
        $users = User::where('role',0)->get();

        return view('admin.users',
        ['users' => $users]
    );
    }
}
