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
        Announcement::create($input);

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil ditambahkan !');
    }

    public function edit($id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('pengumuman.edit', compact('announcement'));
    }

    public function broadcast($id)
    {
        $announcement = Announcement::findOrFail($id);
        $patients = Patient::all();
        foreach ($patients as $patient) {
            $patient->notify(new NotificationsAnnouncement($announcement->content, $announcement->title, $announcement-> updated_at->format('F d, Y'), $announcement->image));
        }

        $announcement->update(['publish' => 1]);
        return redirect()->back()->with('success', 'Pengumuman berhasil di broadcast');
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

        $announcement->forceDelete();
        return back()->with('success', 'Pengumuman berhasil dihapus !');
    }
}
