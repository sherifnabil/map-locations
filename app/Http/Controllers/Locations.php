<?php

namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;

class Locations extends Controller
{
  
    public function index()
    {
        $locations = Location::all();
        $title = 'Locations';
        return view('locations.index', compact('title', 'locations'));
    }

   
    public function create()
    {
        return view('locations.create')->withTitle('Add Location');
        
    }


    public function store(Request $request)
    {
        // dd(request()->address);
        $data = $request->validate([
            'address' => 'required',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
        ]);

        $l = Location::create($data);

        $file = public_path('file' . $l->id . '.json');

        if (!is_file($file)) {
            file_put_contents($file, $l->toJson());     // Save our content to the file.
        }

        return redirect()->route('locations.index');
    }
    


  
    public function show(Location $location)
    {
        //
    }


    public function edit(Location $location)
    {
        $title = 'Edit Location';
        return view('locations.edit', compact('title', 'location'));
        
    }


    public function update(Request $request, Location $location)
    {
        // dd(request()->all());
        $data = $request->validate([
            'address' => 'required',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
        ]);
       $location->update($data);

        $file = public_path('file' . $location->id . '.json');

        if (!is_file($file)) {
            file_put_contents($file, json_encode($data));     // Save our content to the file.
        }

        return redirect()->route('locations.index');
    }


    public function destroy(Location $location)
    {

        $location->delete();

        if(file_exists(public_path('file' . $location->id . '.json')))
        {
            unlink(public_path('file' . $location->id . '.json'));
        }

        return back();
    }
}
