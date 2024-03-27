<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Service;

use App\Http\Requests\StoreRequest;
use App\Http\Requests\UpdateRequest;

class ServiceController extends Controller
{
    
       
        public function index()
        {
            
            $service = Service::all();
            return view('admin.services.index', compact('service'));
        }
    
        
        public function create()
        {
            return view('admin.services.create');
        }
    
        
        public function store(Request $request)
        {
            
    
        }
    
        
        public function show(string $slug)
        {
            
            $Service = Service::where('slug',$slug)->firstOrFail();
            return view('admin.services.show', compact('service'));
        }
    
       
        public function edit(string $slug)
        {
           
            $Service = Service::where('slug',$slug)->firstOrFail();
            return view('admin.services.edit', compact('service'));
        }
    
        public function update(Request $request, Service $service)
        {
            
        }
    
        public function destroy(Service $service)
        {
            $service->delete();
            return redirect()->route('admin.services.index');
        }
    
}
