<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function dashboard()
    {
        $user = auth()->user();
        return view('admin.dashboard', compact('user'));
    }
    

}
