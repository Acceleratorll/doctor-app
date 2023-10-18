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

        $announcement = Announcement::create($input);
        $patients = Patient::all();
        foreach ($patients as $patient) {
            $patient->notify(new NotificationsAnnouncement($announcement->content, $announcement->title, $announcement->created_at));
        }

        return redirect()->route('admin.pengumuman.index');
    }

    public function show($id)
    {
        //
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
        $announcement->update($input);
        return redirect()->route('admin.pengumuman.index');
    }

    public function destroy($id)
    {
        Announcement::findOrFail($id)->delete();
        return back();
    }
}
