<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index');
    }

    public function sair()
    {
        Auth::logout();
        return redirect("/");
    }
}
