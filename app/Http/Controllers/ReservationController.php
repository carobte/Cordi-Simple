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
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::all();
        return view('reservations.index', compact("reservations"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Captura el ID del evento de la solicitud
        $eventId = $request->input('event_id');

        // Obtén el usuario autenticado
        $user = Auth::user(); // Esto te dará un objeto con toda la información del usuario

        // Carga el evento usando el ID
        $event = Event::find($eventId);

        // Retorna la vista con el evento y el usuario
        return view('reservations.create', compact('event', 'user'));
    }

    public function store(ReservationRequest $request)
    {
        $validatedData = $request->validated();
        Reservation::create($validatedData);
        return redirect()->route('events.index')->with('success', 'Reservación creada exitosamente.');
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
