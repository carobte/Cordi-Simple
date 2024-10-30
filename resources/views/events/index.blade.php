@extends('layouts.personal')

@section('content')
    <div class="flex justify-center items-center mb-6 max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800  mx-auto">Eventos</h1>
        <!-- Delete the Auth::check validation when events & reservation routes are protected -->
        @if (Auth::check() && Auth::user()->rol->name == 'administrator')
            <a href="{{ route('events.create') }}" class="bg-blue-500 p-3 text-white rounded hover:bg-blue-600">
                Nuevo evento
            </a>
        @endif
    </div>

    <!-- Container for events -->
    <div class="flex justify-center items-center flex-wrap gap-5 overflow-x-auto max-w-7xl mx-auto w-screen">
        <!-- Each event-->
        @forelse($events as $event)
            <div
                class="relative flex flex-col my-6 bg-white shadow-sm border border-slate-200 rounded-lg w-96 hover:border-slate-300 hover:shadow-md transition-all cursor-pointer">
                <div class="p-4">
                    <a href="{{ route('events.show', $event->id) }}"
                        class="block text-slate-800 text-xl font-semibold capitalize hover:underline">
                        {{ $event->id }}. {{ $event->name }}
                    </a>
                    <p class="text-slate-600 leading-normal font-light my-3">{{ ucfirst($event->description) }}</p>
                    <p class="text-slate-600 leading-normal font-light my-3 capitalize">
                        <span class="text-slate-800">Ubicación:</span> {{ $event->location }}
                    </p>
                    <p class="text-slate-600 leading-normal font-light my-3 capitalize">
                        <span class="text-slate-800">Fecha:</span> {{ $event->date_start }} - {{ $event->date_end }}
                    </p>
                    <p class="text-slate-600 leading-normal font-light my-3 capitalize">
                        <span class="text-slate-800">Capacidad máxima:</span> {{ $event->max_slots }}
                    </p>
                    <p class="text-slate-600 leading-normal font-light my-3 capitalize">
                        <span class="text-slate-800">Estado:</span> {{ $event->status ? 'activo' : 'inactivo' }}
                    </p>
                    <div class="flex justify-end gap-4 mt-4">
                        @if (Auth::check() && Auth::user()->rol->name == 'administrator')
                            <a href="{{ route('events.show', $event->id) }}"
                                class="bg-blue-500 px-3 py-1 text-white rounded hover:bg-blue-600">Detalles</a>
                        @elseif(Auth::check() && Auth::user()->rol->name == 'general user')
                            <a href="{{ route('reservations.create') }}"
                                class="bg-violet-500 px-3 py-1 text-white rounded hover:bg-violet-600">Reservar</a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <tr>
                <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">No hay
                    eventos disponibles.</td>
            </tr>
        @endforelse
    </div>
@endsection
