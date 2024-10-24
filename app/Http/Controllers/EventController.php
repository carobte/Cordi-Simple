<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

//Controllers for Create a New event


public function create()
{
    //Show the Create form
    return view('events.create');
}

Public Function Store(EventRequest $request)
{
    $validatedData = $request->validated();

    // Create category with validated data
    Event::create($validatedData);
    
    // Redirect to the category list with a message
    return redirect()->route('events.index')->with('success', 'event created successfully.');
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
}
