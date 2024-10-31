@extends('layouts.personal')

@section('content')
    <div class="flex justify-center items-center mb-6 max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800  mx-auto">Eventos</h1>
        @if (Auth::user()->rol->name == 'administrator')
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
                    <p class="text-slate-800 text-xl font-semibold capitalize">
                        {{ $event->id }}. {{ $event->name }}
                    </p>
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
                    <p class="text-slate-600 leading-normal font-light my-3 capitalize">
                        <span class="text-slate-800">Creado:</span> {{ $event->created_at->format('d-m-Y H:i:s') }}
                    </p>
                    <p class="text-slate-600 leading-normal font-light my-3 capitalize">
                        <span class="text-slate-800">Ultima Actualización:</span> {{ $event->updated_at->diffForHumans() }}
                    </p>
                    <div class="flex justify-end gap-4 mt-4 items-center">
                        @if (Auth::user()->rol->name == 'administrator')

                            <!-- Enlace para editar -->
                            <div class="inline-block ml-4">

                                <a href="{{ route('events.edit', $event->id) }}"
                                    class="bg-violet-500 px-3 py-2 text-white rounded hover:bg-violet-600">Editar</a>
                                </div>

                            <!-- Formulario para eliminar -->
                            <form action="{{ route('events.destroy', $event->id) }}" method="POST"
                                class="inline-block m-0 event-delete-form" data-event-id="{{ $event->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 px-3 py-1 text-white rounded hover:bg-red-600">Eliminar</button>
                            </form>
                        
                            @elseif(Auth::user()->rol->name == 'general user')
                            <a href="{{ route('reservations.create') }}"
                                class="bg-violet-500 px-3 py-2 text-white rounded hover:bg-violet-600">Reservar
                            </a>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Selecciona todos los formularios de eliminación
        const deleteForms = document.querySelectorAll('.event-delete-form');

        deleteForms.forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Evitar el envío inmediato del formulario

                const eventId = this.getAttribute('data-event-id');
                Swal.fire({
                    title: "¿Estás seguro que quieres eliminar el evento " + eventId +
                        "?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, eliminar!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Eliminado!",
                            icon: "success"
                        });
                        this.submit();
                    }
                });
            });
        });
    });
</script>
