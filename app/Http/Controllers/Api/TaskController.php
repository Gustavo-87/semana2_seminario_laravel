<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tareas = Task::with(['category', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();

        return TaskResource::collection($tareas);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:150|unique:tasks,titulo',
            'descripcion' => 'nullable|string',
            'fecha_limite' => 'nullable|date',
            'estado' => 'required|in:pendiente,en_progreso,completada',
            'category_id' => 'required|exists:categories,id',
        ]);

        $tarea = Task::create($validated + [
            'user_id' => $request->user()->id,
        ]);

        $tarea->load(['category', 'user']);

        return new TaskResource($tarea);
    }

    public function show(Task $tarea)
    {
        $tarea->load(['category', 'user']);

        return new TaskResource($tarea);
    }

    public function update(Request $request, Task $tarea)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:150|unique:tasks,titulo,' . $tarea->id,
            'descripcion' => 'nullable|string',
            'fecha_limite' => 'nullable|date',
            'estado' => 'required|in:pendiente,en_progreso,completada',
            'category_id' => 'required|exists:categories,id',
        ]);

        $tarea->update($validated);
        $tarea->load(['category', 'user']);

        return new TaskResource($tarea);
    }

    public function destroy(Task $tarea)
    {
        $tarea->delete();

        return response()->json([
            'message' => 'Tarea eliminada correctamente.',
        ]);
    }
}
