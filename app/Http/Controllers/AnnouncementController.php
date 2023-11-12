<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnnouncementRequest;
use App\Models\Announcement;
use App\Models\Patient;
use App\Notifications\Announcement as NotificationsAnnouncement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::orderBy('created_at', 'desc')->get();
        return view('pengumuman.index', compact('announcements'));
    }

    public function create()
    {
        return view('pengumuman.create');
    }

    public function store(AnnouncementRequest $request)
    {
        $input = $request->validated();
        $image = $request->file('image');
        if ($image) {
            $image = $image->store('announcement', 'public');
            $input['image'] = $image;
        }
        $announcement = Announcement::create($input);
        $patients = Patient::all();
        foreach ($patients as $patient) {
            $patient->notify(new NotificationsAnnouncement($announcement->content, $announcement->title, $announcement->created_at));
        }

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil ditambahkan !');
    }

    public function edit($id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('pengumuman.edit', compact('announcement'));
    }

    public function update(AnnouncementRequest $request, $id)
    {
        $announcement = Announcement::findOrFail($id);
        $input = $request->validated();
        $image = $request->file('image');
        if ($image) {
            $image = $image->store('announcement', 'public');
            $input['image'] = $image;
        }
        $announcement->update($input);
        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil diupdate !');
    }

    public function destroy($id)
    {
        $announcement = Announcement::findOrFail($id);

        if ($announcement->image) {
            Storage::disk('public')->delete($announcement->image);
        }

        $announcement->delete();
        return back()->with('success', 'Pengumuman berhasil dihapus !');
    }
}
