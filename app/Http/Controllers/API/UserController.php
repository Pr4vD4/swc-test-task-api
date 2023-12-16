<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Http\Resources\UserResource;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'error' => null,
            'result' => UserResource::collection(User::all())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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

    public function delete()
    {

        $user = auth()->user();
        $user->events()->detach();
        auth()->user()->delete();
        auth()->logout();

        return response()->json([
            'error' => null,
            'result' => [
                'message' => 'Successfully deleted',
                'user' => new UserResource($user)
            ]
        ]);

    }

    public function profile(Request $request)
    {
        return response()->json([
            'error' => null,
            'result' => new UserResource(auth()->user())
        ]);
    }

    public function events()
    {
        return response()->json([
            'error' => null,
            'result' => EventResource::collection(auth()->user()->events)
        ]);
    }

    public function user_events()
    {
        return response()->json([
            'error' => null,
            'result' => EventResource::collection(auth()->user()->user_events)
        ]);
    }

//    Add an event to user
    public function add_event(Request $request, string $event_id)
    {
        $user = auth()->user();

        $user->events()->syncWithoutDetaching($event_id);

        return response()->json([
            'error' => null,
            'result' => new UserResource($user)
        ]);
    }

    //    Remove event from user
    public function detach_event(Request $request, string $event_id)
    {
        $user = auth()->user();

        $user->events()->detach($event_id);

        return response()->json([
            'error' => null,
            'result' => new UserResource($user)
        ]);
    }


}
