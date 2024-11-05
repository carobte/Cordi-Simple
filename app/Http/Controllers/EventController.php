<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Http\Requests\EventUpdateRequest;
use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventController extends Controller
{

    /**
     * Display a listing of the resource.
     * Retrieves all events and returns the 'events.index' view to display them.
     */

    public function index()
    {
        $events = Event::all();
        return view('events.index', compact("events"));
    }

    /**
     * Show the form for creating a new event.
     * Returns the 'events.create' view where the user can fill out event details.
     */

    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created event in storage.
     * Validates the request data, sets 'occupied_slots' to 0, and saves the new event.
     * Redirects to the event list with a success message upon completion.
     */

    public function Store(EventRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['occupied_slots'] = 0;
        Event::create($validatedData);

        return redirect()->route('events.index')->with('success', 'event created successfully.');
    }

    /**
     * Show the form for editing the specified event.
     * Retrieves the event by ID and parses start and end dates using Carbon for proper date handling.
     * Returns the 'events.edit' view with the event data.
     */

    public function edit(string $id)
    {
        $event = Event::findOrFail($id);

        // Asegúrate de convertir las fechas a Carbon
        if (is_string($event->date_start)) {
            $event->date_start = Carbon::parse($event->date_start);
        }
        if (is_string($event->date_end)) {
            $event->date_end = Carbon::parse($event->date_end);
        }

        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified event in storage.
     * Validates and updates the event data, then redirects to the event list with a success message.
     */

     public function update(EventUpdateRequest $request, string $id)
     {
         $validatedData = $request->validated();

         $event = Event::findOrFail($id);
         $event->update($validatedData);

         return redirect()->route('events.index')->with('success', 'Evento actualizado exitosamente.');
     }


    /**
     * Remove the specified event from storage.
     * Finds and deletes the event by ID, then redirects to the event list with a success message.
     */

    public function destroy(string $id)
    {

        $event = Event::findOrFail($id);

        // Establecer el estado del evento como false
        $event->status = false;
        $event->save(); // Guardar los cambios en el evento

        // Encontrar todas las reservas asociadas con el evento
        $reservations = Reservation::where('event_id', $event->id)->get();

        // Actualizar el campo 'status' de cada reserva a false
        foreach ($reservations as $reservation) {
            $reservation->status = false;
            $reservation->save(); // Guardar cada reserva con el nuevo estado
        }
        return redirect()->route('events.index');
    }
}
