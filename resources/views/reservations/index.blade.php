@extends('layouts.personal')

@section('content')
    <div class="container mx-auto py-8">
        @if (Auth::user()->rol->name == 'administrator')
            <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Reservas</h1>
        @else
            <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Mis Reservas</h1>
        @endif

        {{-- Check if there are no reservations for the user --}}
        @if ($reservations->isEmpty())
            <p class="text-gray-700 text-center">No tienes reservas en este momento.</p>
        @else
            {{-- Display each reservation in a card layout --}}
            <div class="flex justify-center items-center flex-wrap gap-5 overflow-x-auto max-w-7xl mx-auto">
                @foreach ($reservations as $reservation)
                    <div
                        class="relative flex flex-col my-6 bg-white shadow-sm border border-slate-200 rounded-lg w-96 hover:border-slate-300 hover:shadow-md transition-all cursor-pointer">
                        <div class="p-4">

                            {{-- Reserve details --}}
                            <p class="leading-normal text-slate-800 text-lg font-semibold"><strong>ID de la
                                    Reserva:</strong>
                                {{ $reservation->id }}</p>
                            <p class="leading-normal text-slate-800 text-lg font-semibold"><strong>Evento:</strong>
                                <span class="text-slate-600 font-light my-3 capitalize">
                                    {{ $reservation->event->name }}
                                </span>
                            </p>
                            @if (Auth::user()->rol->name == 'administrator')

                                <p class="leading-normal text-slate-800 text-lg font-semibold"><strong>Asistente:</strong>
                                    <span class="text-slate-600 font-light my-3 capitalize">
                                        {{ $reservation->user->name }}
                                    </span>
                                <p class="leading-normal text-slate-800 text-lg font-semibold"><strong>Email:</strong>
                                    <span class="text-slate-600 font-light my-3">
                                        {{ $reservation->user->email }}
                                    </span>
                                </p>
                            @endif
                                </p>
                                <p class="leading-normal text-slate-800 text-lg font-semibold"><strong>Ubicación:</strong>
                                    <span class="text-slate-600 font-light my-3 capitalize">
                                        {{ $reservation->event->location }}
                                    </span>
                                </p>
                                <p class="leading-normal text-slate-800 text-lg font-semibold"><strong>Fecha de
                                        Inicio:</strong>
                                    <span class="text-slate-600 font-light my-3">
                                        {{ $reservation->event->date_start }}
                                    </span>
                                </p>
                                <p class="leading-normal text-slate-800 text-lg font-semibold"><strong>Fecha de
                                        Finalización:</strong>
                                    <span class="text-slate-600 font-light my-3">
                                        {{ $reservation->event->date_end }}
                                    </span>
                                </p>

                                <p
                                    class="{{ $reservation->status == 0 ? 'text-red-800' : 'text-green-800' }} font-semibold text-lg leading-normal my-3">
                                    <strong>Estado:</strong> {{ $reservation->status == 0 ? 'Cancelado' : 'Activo' }}
                                </p>

                                <div class="flex justify-end mt-4">

                                    {{-- Form to update reservation status (cancel) --}}
                                    <form action="{{ route('reservations.update', $reservation->id) }}" method="POST"
                                        class="update-reservation-form" data-reservation-id="{{ $reservation->id }}"
                                        data-event-name="{{ $reservation->event->name }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="0">

                                        {{-- Show the "Cancelar Reserva" button only if the reservation is not canceled --}}
                                        @if ($reservation->status != 0)
                                            <button type="submit"
                                                class="bg-red-500 px-3 py-1 text-white rounded hover:bg-red-600">
                                                Cancelar Reserva
                                            </button>
                                        @else
                                            {{-- Display "Cancelado" if the reservation has been canceled --}}
                                            <a href="#"
                                                class="bg-gray-400 px-3 py-1 text-white rounded cursor-not-allowed">
                                                Cancelado
                                            </a>
                                        @endif
                                    </form>
                                </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

<!-- Script for SweetAlert -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Selects all reservation update forms
        const updateForms = document.querySelectorAll('.update-reservation-form');

        // Adds an event listener for each form to confirm cancellation before submission
        updateForms.forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevents form from submitting immediately

                // Retrieve the event name for display in the confirmation alert
                const eventName = this.getAttribute('data-event-name'); // Get the event name

                // Displays a confirmation dialog to the user
                Swal.fire({
                    title: "¿Estás seguro que quieres cancelar la reserva de '" +
                        eventName + "'?",
                    text: "Esta acción no se puede deshacer.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, cancelar!",
                    cancelButtonText: "No, volver"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If the user confirms, display a success message before form submission
                        Swal.fire({
                            title: "Reserva cancelada!",
                            icon: "success"
                        }).then(() => {
                            this
                                .submit(); // Submit the form if cancellation is confirmed
                        });
                    }
                });
            });
        });
    });
</script>
