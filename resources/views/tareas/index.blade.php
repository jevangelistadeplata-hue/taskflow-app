<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tareas - TaskFlow</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 text-slate-800 p-8">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-slate-900">TaskFlow - Gestión de Tareas</h1>
            <a href="{{ route('tareas.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-md">
                + Nueva Tarea
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-200">
                        <th class="p-3 border-b">Título</th>
                        <th class="p-3 border-b">Estado</th>
                        <th class="p-3 border-b">Fecha Límite</th>
                        <th class="p-3 border-b">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tareas as $tarea)
                        <tr class="border-b hover:bg-slate-50">
                            <td class="p-3 font-medium">{{ $tarea->titulo }}</td>
                            <td class="p-3">
                                <span class="px-2 py-1 text-xs rounded-full 
                                    @if($tarea->estado == 'completada') bg-green-100 text-green-800
                                    @elseif($tarea->estado == 'en_progreso') bg-yellow-100 text-yellow-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst(str_replace('_', ' ', $tarea->estado)) }}
                                </span>
                            </td>
                            <td class="p-3">{{ $tarea->fecha_limite ?? 'Sin fecha' }}</td>
                            <td class="p-3 flex space-x-2">
                                <a href="{{ route('tareas.edit', $tarea) }}" class="text-blue-600 hover:underline">Editar</a>
                                <form action="{{ route('tareas.destroy', $tarea) }}" method="POST" onsubmit="return confirm('¿Eliminar esta tarea?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-4 text-center text-slate-500">No hay tareas registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>