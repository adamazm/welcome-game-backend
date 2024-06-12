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
        //
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

    /**
     * Join the specified event.
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
