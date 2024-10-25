@extends('layouts.personal')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Detalles del evento: {{$event -> id}}</h1>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="px-8 py-6">

            <div class="mb-4">
                <h2 class="text-2xl font-bold text-gray-700 mb-2">Nombre del evento:</h2>
                <p class="text-gray-600 text-lg capitalize">{{ $event->name }}</p>
            </div>


            <div class="mb-4">
                <h3 class="text-xl font-bold text-gray-700 mb-2">Descripción:</h3>
                <p class="text-gray-600 text-lg">{{ ucfirst($event->description) }}</p>
            </div>

            <div class="mb-4">
                <h3 class="text-xl font-bold text-gray-700 mb-2">Fecha de inicio:</h3>
                <p class="text-gray-600 text-lg">{{ $event->date_start }}</p>
            </div>
            <div class="mb-4">
                <h3 class="text-xl font-bold text-gray-700 mb-2">Fecha de finalización:</h3>
                <p class="text-gray-600 text-lg">{{ $event->date_end }}</p>
            </div>            <div class="mb-4">
                <h3 class="text-xl font-bold text-gray-700 mb-2">Ubicación:</h3>
                <p class="text-gray-600 text-lg capitalize">{{ $event->location }}</p>
            </div>            <div class="mb-4">
                <h3 class="text-xl font-bold text-gray-700 mb-2">Capacidad máxima:</h3>
                <p class="text-gray-600 text-lg">{{ $event->max_slots }}</p>
            </div>            <div class="mb-4">
                <h3 class="text-xl font-bold text-gray-700 mb-2">Estado</h3>
                <p class="text-gray-600 text-lg capitalize">{{ $event->status ? 'activo' : 'inactivo' }} </p>
            </div>

            <div class="mb-4">
                <h3 class="text-xl font-bold text-gray-700 mb-2">Creada el:</h3>
                <p class="text-gray-600 text-lg">{{ $event->created_at->format('d-m-Y H:i:s') }}</p>
            </div>


            <div class="mb-4">
                <h3 class="text-xl font-bold text-gray-700 mb-2">Última actualización:</h3>
                <p class="text-gray-600 text-lg">{{ $event->updated_at->diffForHumans() }}</p>
            </div>


            <div class="flex justify-end mt-6">
                <a href="{{ route('events.index') }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 mr-2">Volver a la lista</a>
                <a href="{{ route('events.edit', $event->id) }}"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Editar evento</a>
                <a href="{{ route('events.destroy', $event->id) }}"
                        class="bg-red-800 text-white px-4 py-2 rounded hover:bg-red-600">Eliminar evento</a>
            </div>
        </div>
    </div>
</div>
@endsection