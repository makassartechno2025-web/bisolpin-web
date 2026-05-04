<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->paginate(15);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            'description'       => 'nullable|string',
            'event_date'        => 'required|date',
            'location'          => 'nullable|string|max:255',
            'image'             => 'nullable|image|max:5120',
            'registration_link' => 'nullable|url',
            'is_free'           => 'boolean',
            'is_published'      => 'boolean',
        ]);

        $validated['slug']         = Str::slug($validated['title']);
        $validated['is_free']      = $request->boolean('is_free', true);
        $validated['is_published'] = $request->boolean('is_published', false);

        if ($request->hasFile('image')) {
            $uploaded = $request->file('image')->storeOnCloudinary('bisolpin/events');
            $validated['image_url'] = $uploaded->getSecurePath();
        }

        Event::create($validated);

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil ditambahkan!');
    }

    public function edit(Event $event)
    {
        return view('admin.events.form', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            'description'       => 'nullable|string',
            'event_date'        => 'required|date',
            'location'          => 'nullable|string|max:255',
            'image'             => 'nullable|image|max:5120',
            'registration_link' => 'nullable|url',
            'is_free'           => 'boolean',
            'is_published'      => 'boolean',
        ]);

        $validated['is_free']      = $request->boolean('is_free', true);
        $validated['is_published'] = $request->boolean('is_published', false);

        if ($request->hasFile('image')) {
            $uploaded = $request->file('image')->storeOnCloudinary('bisolpin/events');
            $validated['image_url'] = $uploaded->getSecurePath();
        }

        $event->update($validated);

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil diperbarui!');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dihapus!');
    }

    public function show(Event $event)
    {
        return redirect()->route('admin.events.edit', $event);
    }
}
