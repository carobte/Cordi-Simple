<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use App\Models\Event;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reservations.create');
    }

    public function store(ReservationRequest $request)
    {
        $validatedData = $request->validated();

       // Get the event using the ID provided in the request
        $event = Event::find($validatedData['event_id']);

        // Check if the event exists and its state
        if ($event->status == 0) {
            return redirect()->back()->withErrors(['event_id' => 'El evento no está activo.'])->withInput();
        }

        // If the event is active, create the reservation
        Reservation::create($validatedData);

        return redirect()->route('reservations.index')->with('success', 'Reservación creada exitosamente.');
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
