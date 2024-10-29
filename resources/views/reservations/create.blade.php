@extends('layouts.personal')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Crear una nueva reserva</h1>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <form action="{{ route('reservations.store') }}" method="POST" class="px-8 py-8" id="create-reservation-form">
                @csrf

                <div class="mb-4">
                    <label for="user_id" class="block text-gray-700 font-bold mb-2">ID del Usuario:</label>
                    <input type="number" name="user_id" id="user_id"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                        value="{{ old('user_id') }}" required>
                    @error('user_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="event_id" class="block text-gray-700 font-bold mb-2">ID del Evento:</label>
                    <input type="number" name="event_id" id="event_id"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                        value="{{ old('event_id') }}" required>
                    @error('event_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="status" class="block text-gray-700 font-bold mb-2">Estado:</label>
                    <select name="status" id="status"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500" required>
                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('status')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="created_at" class="block text-gray-700 font-bold mb-2">Fecha de Creación:</label>
                    <input type="date" name="created_at" id="created_at"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                        value="{{ old('created_at') }}">
                    @error('created_at')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="modified_at" class="block text-gray-700 font-bold mb-2">Fecha de Modificación:</label>
                    <input type="date" name="modified_at" id="modified_at"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                        value="{{ old('modified_at') }}">
                    @error('modified_at')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('reservations.index') }}"
                        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 mr-2">Cancelar</a>
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Crear nueva reserva</button>
                </div>
            </form>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('create-reservation-form').addEventListener('submit', function(event) {
            event.preventDefault();

            Swal.fire({
                title: "¿Quieres agregar esta nueva reserva?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Guardar",
                denyButtonText: `No guardar`
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire("Reserva agregada con éxito!", "", "success").then(() => {
                        this.submit();
                    });
                } else if (result.isDenied) {
                    Swal.fire("Se canceló la creación", "", "info");
                }
            });
        });
    });
</script>
