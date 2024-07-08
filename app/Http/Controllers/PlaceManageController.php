<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaceRequest;
use App\Models\Place;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlaceManageController extends Controller
{
    public function index()
    {
        $places = Place::latest()->get();
        return view('tempat.index', compact('places'));
    }

    public function create()
    {
        return view('tempat.create');
    }

    public function store(PlaceRequest $request)
    {
        $input = $request->validated();

        if(Place::all()->count() >= 2){
            return redirect()->route('admin.tempat.index')->with('error', 'Maaf, tidak dapat menambahkan lebih dari 2 tempat !');
        }

        Place::create($input);
        return redirect()->route('admin.tempat.index')->with('success', 'Tempat created successfully !');
    }

    public function show($id)
    {
        $place = Place::find($id);
        return view('tempat.show', compact('place'));
    }

    public function edit($id)
    {
        $place = Place::findOrFail($id);
        return view('tempat.edit', compact(['place']));
    }

    public function update(PlaceRequest $request, $id)
    {
        $place = Place::findOrFail($id);
        $input = $request->validated();

        $place->update($input);

        return redirect()->route('admin.tempat.index')->with('success', 'Tempat updated successfully !');
    }

    public function destroy($id)
    {
        $place = Place::findOrFail($id);
        $schedules = Schedule::where('place_id', $place->id)->get();

        foreach ($schedules as $schedule) {
            $schedule->update(['place_id' => null]);
        }

        $place->forceDelete();

        return back()->with('success', 'Tempat deleted successfully !');
    }
}
