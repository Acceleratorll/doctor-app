<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaceRequest;
use App\Models\Place;
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

        $place = Place::create($input);
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imagePath = $request->file('image')->store('place_images', 'public');
            $place->update([
                'image' => $imagePath
            ]);
        }
        return redirect()->route('admin.tempat.index');
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
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if ($place->image && Storage::exists($place->image)) {
                Storage::delete($place->image);
            }

            $imagePath = $request->file('image')->store('place_images', 'public');
            $place->update([
                'image' => $imagePath
            ]);
        }

        return redirect()->route('admin.tempat.index');
    }

    public function destroy($id)
    {
        Place::findOrFail($id)->delete();
        return back();
    }
}
