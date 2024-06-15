<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        return response()->json(['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function events(string $id)
    {
        $user = User::find($id);
        
        $allEvents = Event::all();
        $joinedEvents = $user->events()->pluck('events.id')->toArray();
        $eventsWithJoinStatus = $allEvents->map(function ($event) use ($joinedEvents) {
            $event->joined = in_array($event->id, $joinedEvents);
            return $event;
        });

        return response()->json(['events' => $eventsWithJoinStatus]);
    }

}
