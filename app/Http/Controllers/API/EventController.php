<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'error' => null,
            'result' => EventResource::collection(Event::all())
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
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'text' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(new ErrorResource($validator->errors()), 400);
        }

        $event = Event::create(array_merge(
            $validator->validated(),
            ['author' => auth()->user()->id]
        ));

        return response()->json([
            'error' => null,
            'result' => new EventResource($event)
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return response()->json([
            'error' => null,
            'result' => new EventResource($event)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
    }

    public function delete_user_event(Request $request, string $id)
    {
        $event = auth()->user()->user_events->find($id);

        if (!$event) {
            return response()->json(new ErrorResource('Event not found'), 400);
        }

        $event->delete();

        return response()->json([
            'error' => null,
            'result' => [
                'message' => 'Successfully deleted',
                'event' => new EventResource($event)
            ]
        ]);

    }

}
