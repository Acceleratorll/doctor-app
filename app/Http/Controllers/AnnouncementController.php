<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnnouncementRequest;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $announcements = Announcement::all();
        return view('pengumuman.index', compact('announcements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengumuman.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnnouncementRequest $request)
    {
        $input = $request->validated();

        $announcement = Announcement::create($input);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if ($announcement->image && Storage::exists($announcement->image)) {
                Storage::delete($announcement->image);
            }

            $imagePath = $request->file('image')->store('announcement_images', 'public');

            $announcement->update([
                'image' => $imagePath
            ]);
        }

        return redirect()->route('admin.pengumuman.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('pengumuman.edit', compact('announcement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AnnouncementRequest $request, $id)
    {
        $announcement = Announcement::findOrFail($id);
        $input = $request->validated();
        $announcement->update($input);
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if ($announcement->image && Storage::exists($announcement->image)) {
                Storage::delete($announcement->image);
            }

            $imagePath = $request->file('image')->store('announcement_images', 'public');

            $announcement->update([
                'image' => $imagePath
            ]);
        }


        return redirect()->route('admin.pengumuman.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Announcement::findOrFail($id)->delete();
        return back();
    }
}
