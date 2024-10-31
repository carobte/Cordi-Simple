@extends('layouts.personal')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Confirmar reserva</h1>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="px-8 py-8">
                <h2 class="text-xl font-bold mb-4">Detalles de tu Reserva</h2>

                <p class="text-gray-700 capitalize"><strong>Nombre del Evento:</strong> {{ $event->name }}</p>
                <p class="text-gray-700 "><strong>Descripción:</strong> {{ ucfirst($event->description) }}</p>
                <p class="text-gray-700 capitalize"><strong>Ubicacion:</strong> {{ $event->location }}</p>
                <p class="text-gray-700"><strong>Fecha de Inicio:</strong> {{ $event->date_start }}</p>
                <p class="text-gray-700"><strong>Fecha de Finalización:</strong> {{ $event->date_end }}</p>

                <hr class="my-4">
        
                <p class="text-gray-700 capitalize"><strong>Nombre:</strong> {{ $user->name }}</p>
                <p class="text-gray-700"><strong>Email:</strong> {{ $user->email }}</p>


                <form action="{{ route('reservations.store') }}" method="POST" id="create-reservation-form">
                    @csrf

                    <input type="hidden" name="event_id" value="{{ $event->id }}">
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <input type="hidden" name="status" value="1">
                    <input type="hidden" name="created_at" value="{{ now() }}">
                    <input type="hidden" name="modified_at" value="{{ now() }}">

            
                    <div class="flex justify-end">
                        <a href="{{ route('events.index') }}"
                            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 mr-2">Cancelar</a>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Crear nueva
                            reserva</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
