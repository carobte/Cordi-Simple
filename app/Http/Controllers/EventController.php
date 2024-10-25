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

    public function Store(EventRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['occupied_slots'] = 0; // Asegúrate de usar el mismo array

        // Crea el evento con los datos validados
        Event::create($validatedData);

        // Redirige a la lista de eventos con un mensaje
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
        // Obtenemos el evento por ID
        $event = Event::findOrFail($id);
        // Retornamos la vista para editar el evento
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventRequest $request, string $id)
    {
        $validatedData = $request->validated();

        $event = Event::findOrFail($id);
        $event->update($validatedData);

        return redirect()->route('events.create')->with('success', 'Evento actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
