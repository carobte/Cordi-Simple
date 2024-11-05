<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{

    /**
     * Display a listing of the user's active reservations.
     */
    public function index()
    {
        $reservations = Reservation::where('user_id', Auth::id())
            ->get();
        return view('reservations.index', compact("reservations"));
    }

    /**
     * Show the form for creating a new reservation.
     */
    public function create(Request $request)
    {
        // Capture the event ID from the request
        $eventId = $request->input('event_id');

        // Get the authenticated user
        $user = Auth::user(); // Retrieves the entire user object

        // Load the event using the event ID
        $event = Event::find($eventId);

        // Return the view with event and user data
        return view('reservations.create', compact('event', 'user'));
    }

    /**
     * Store a newly created reservation in the database.
     */
    public function store(ReservationRequest $request)
    {
        // Validate and create the reservation
        $validatedData = $request->validated();
        Reservation::create($validatedData);

        // Increment the occupied_slots field for the associated event
        $event = Event::find($validatedData['event_id']);
        $event->increment('occupied_slots');

        // Redirect to events page with success message
        return redirect()->route('events.index')->with('success', 'Reservation successfully created.');
    }

    /**
     * Display the specified reservation details.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified reservation.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the status of the specified reservation.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request to ensure 'status' is a boolean
        $request->validate([
            'status' => 'required|boolean',
        ]);

        // Find the reservation by its ID
        $reservation = Reservation::findOrFail($id);

        // Check if the reservation is active and is being canceled (status set to 0)
        if ($reservation->status === 1 && $request->input('status') == 0) {
            // Retrieve the event associated with this reservation
            $event = $reservation->event;

            // Decrement the event's occupied_slots by 1
            $event->decrement('occupied_slots');
        }

        // Update the reservation's status
        $reservation->status = $request->input('status');

        // Save changes to the reservation
        $reservation->save();

        // Redirect back to reservation list with success message
        return redirect()->route('reservations.index')->with('success', 'Reservation successfully canceled.');
    }

    /**
     * Remove the specified reservation from storage.
     */
    public function destroy(string $id) {}
}
