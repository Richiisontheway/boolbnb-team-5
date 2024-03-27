<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
//controller
use App\Http\Controllers\Controller;

//model
use App\Models\Sponsor;

// http://127.0.0.1:8000/admin/sponsors
//helper
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SponsorController extends Controller
{

    public function index()
    {
        $sponsors = Sponsor::all();
        return view('admin.sponsors.index', compact('sponsors'));
    }


}
