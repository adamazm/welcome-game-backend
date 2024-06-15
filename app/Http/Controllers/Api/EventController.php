<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $events = Event::all();
        return response()->json(['events' => $events], 200);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * => @param string $request->title
     * => @param string $request->description
     * => @param string $request->start_date
     * => @param string $request->end_date
     * => @param string $request->latitude
     * => @param string $request->longitude
     * => @param string $request->radius
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->is_admin == 0) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'string',
            'start_date' => 'date',
            'end_date' => 'date',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'radius' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([$validator->errors(), 422]);
        }

        $event = Event::create($validator->validated());
        return response()->json(['event' => $event], 201);
    }

    /**
     * Display the specified resource.
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        $event = Event::find($id);
        return response()->json(['event' => $event], 200);
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
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
        $user = Auth::user();

        if ($user->is_admin == 0) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        Event::destroy($id);
        return response()->json(['message' => 'Event deleted successfully'], 200);
    }

    /**
     * Join the specified event.
     * @param Request $request
     * => @param string $request->user_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function joinEvent(Request $request, string $id)
    {
        $user = Auth::user();

        if ($user->events->contains($id)) {
            return response()->json(['message' => 'Already joined event'], 400);
        }
        
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json([$validator->errors(), 422]);
        }

        if ($user->id == $request->user_id) {
            Event::find($id)->users()->attach($request->user_id);
            return response()->json(['message' => 'Joined event successfully']);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        

    }

    /**
     * Unjoin the specified event.
     * @param Request $request
     * => @param string $request->user_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function unjoinEvent(Request $request, string $id)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json([$validator->errors(), 422]);
        }

        if ($user->id != $request->user_id) {
            return response()->json(['message' => 'Unauthorized'], 401);
        } else {
            Event::find($id)->users()->detach($request->user_id);
            return response()->json(['message' => 'Unjoined event successfully']);
        }
        
    }
}
