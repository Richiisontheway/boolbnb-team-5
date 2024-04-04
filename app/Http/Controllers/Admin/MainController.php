<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
class MainController extends Controller
{

    public function dashboard()
    {
        $user = auth()->user();
        return view('admin.dashboard', compact('user'));
    }
    public function trash(Apartment $apartment)
    {
        $apartment = Apartment::all(); 
        return view('admin.trash', compact('apartment'));
    }
    

}
