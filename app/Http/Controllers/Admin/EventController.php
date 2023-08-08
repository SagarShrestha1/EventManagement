<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currentDate = Carbon::now();
        if ($request->search == "finish_event") {
            
            $events = Event::where('end_date', '<', $currentDate)->orderBy('end_date', 'asc')->paginate(10);
        }elseif ($request->search == "upcoming_event") {
            $events = Event::where('start_date', '>=', $currentDate)->orderBy('start_date', 'asc')->paginate(10);
        } else {
            $events = Event::orderBy('start_date', 'asc')->paginate(10);
        }

        return view('admin.event.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.event.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:250',
            'description' => 'required|string|max:1000',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'display' => 'nullable|boolean',
        ]);
        $event = new Event;
        $event->title = $request->title;
        $event->description = $request->description;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->display = $request->display ?? 0;
        $event->created_by = Auth::user()->name;
        $status = $event->save();
        if ($status) {
            return redirect()->route('admin.events.index')->with('status', 'Successfully Creted!');
        }
        return redirect()->route('admin.events.index')->with('error', 'Something error!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('admin.event.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('admin.event.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        // return $event;
        $this->validate($request, [
            'title' => 'required|string|max:250',
            'description' => 'required|string|max:1000',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'display' => 'nullable|boolean',
        ]);
        $event->title = $request->title;
        $event->description = $request->description;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->display = $request->display ?? 0;
        $event->created_by = Auth::user()->name;
        $status = $event->update();
        if ($status) {
            return redirect()->route('admin.events.index')->with('status', 'Successfully Updated!');
        }
        return redirect()->route('admin.events.index')->with('error', 'Something error!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function deleteAjax(Request $request)
    {
        // return $request;
        $event = Event::findOrFail($request->id);
        $event->delete();
        return response()->json([
            'success' => 'Event deleted successfully!',
        ]);
    }
}
