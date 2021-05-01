<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        return view('backend.index');
    }

    public function profile(){
        $user = Auth::user();
        return view('backend.users.profile', compact('user'));
    }
}
