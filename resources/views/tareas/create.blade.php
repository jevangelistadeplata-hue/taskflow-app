<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Tarea - TaskFlow</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 text-slate-800 p-8">
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-slate-900 mb-6">Crear Nueva Tarea</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tareas.store') }}" method="POST" class="space-y-4">
            @csrf
            
            <div>
                <label for="titulo" class="block font-medium text-slate-700">Título</label>
                <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}" required
                    class="w-full mt-1 p-2 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div>
                <label for="descripcion" class="block font-medium text-slate-700">Descripción</label>
                <textarea name="descripcion" id="descripcion" rows="3"
                    class="w-full mt-1 p-2 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('descripcion') }}</textarea>
            </div>

            <div>
                <label for="estado" class="block font-medium text-slate-700">Estado</label>
                <select name="estado" id="estado" required
                    class="w-full mt-1 p-2 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="pendiente">Pendiente</option>
                    <option value="en_progreso">En Progreso</option>
                    <option value="completada">Completada</option>
                </select>
            </div>

            <div>
                <label for="fecha_limite" class="block font-medium text-slate-700">Fecha Límite</label>
                <input type="date" name="fecha_limite" id="fecha_limite" value="{{ old('fecha_limite') }}"
                    class="w-full mt-1 p-2 border border-slate-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div class="flex justify-end space-x-2 pt-4">
                <a href="{{ route('tareas.index') }}" class="bg-slate-300 hover:bg-slate-400 text-slate-800 px-4 py-2 rounded-md">Cancelar</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-md">Guardar Tarea</button>
            </div>
        </form>
    </div>
</body>
</html>