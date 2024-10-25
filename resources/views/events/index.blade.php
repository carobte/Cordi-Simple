@extends('layouts.personal') 

@section('content')

<h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Lista de Eventos</h1>
    
    <div class="flex justify-center mb-4">
        <a href="{{ route('events.create') }}" class="bg-blue-500 p-3 text-white rounded hover:bg-blue-600">Nuevo
            evento</a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-x-auto max-w-7xl mx-auto w-screen">
        <table class="w-ful table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Descripción</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha de
                        inicio
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha de
                        finalización
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ubicación
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Capacidad
                        máxima
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($events as $event)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap capitalize">{{ $event->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap capitalize">{{ $event->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $event->description }}</td>
                        <td class="px-6 py-4 whitespace-nowrap capitalize">{{ $event->date_start }}</td>
                        <td class="px-6 py-4 whitespace-nowrap capitalize">{{ $event->date_end }}</td>
                        <td class="px-6 py-4 whitespace-nowrap capitalize">{{ $event->location }}</td>
                        <td class="px-6 py-4 whitespace-nowrap capitalize">{{ $event->max_slots }}</td>
                        <!-- Ternary operator that validates the Boolean that arrives from the database -->
                        <td class="px-6 py-4 whitespace-nowrap capitalize">
                            {{ $event->status ? 'activo' : 'inactivo' }} 
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <!-- Enlace a la vista de detalles -->
                            <a href="{{ route('events.show', $event->id) }}"
                                class="text-blue-600 hover:text-blue-800">Detalles</a>

                            <!-- Enlace para editar -->
                            <a href="{{ route('events.edit', $event->id) }}"
                                class="text-indigo-600 hover:text-indigo-800 ml-4">Editar</a>

                            <!-- Formulario para eliminar -->
                            <form action="{{ route('events.destroy', $event->id) }}" method="POST"
                                class="inline-block ml-4">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">Eliminar</button>
                            </form>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">No hay
                            eventos disponibles.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
