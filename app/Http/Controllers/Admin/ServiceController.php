<?php

namespace App\Http\Controllers\Admin;
//controller
use App\Http\Controllers\Controller;
// Models
use App\Models\Service;
//Request

//helper
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    
       
    public function index()
    {
        
        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }


    public function create()
    {
        return view('admin.services.create');
    }


    public function store($request)
    {
        $service_data = $request->validated();
        $service = Service::create([
            'title' => $service_data['title'],
            'icon' => $service_data['icon'],
        ]);
        return redirect()->route('admin.services.show', compact('service'));
    }


    public function show(string $id)
    {

        // Recupera il servizio corrispondente all'ID fornito            
        $service = Service::findOrFail($id);

        $apartments = $service->apartments()->get();
        // Passa il servizio alla vista per la visualizzazione
        return view('admin.services.show', compact('service','apartments'));
    }



    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $service_data = $request->validated();
        $service = Service::create([
            'title' => $service_data['title'],
            'icon' => $service_data['icon'],
        ]);
        return redirect()->route('admin.services.show', compact('service'));
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index');
    }
    
}
