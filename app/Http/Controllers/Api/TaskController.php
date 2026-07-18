<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    public function index()
    {
        Gate::forUser(auth('api')->user())
            ->authorize('viewAny', Task::class);

        $user = auth('api')->user();

        $query = Task::with(['category', 'user'])
            ->orderByDesc('created_at');

        if ($user->rol !== 'admin') {
            $query->where('user_id', $user->id);
        }

        return TaskResource::collection($query->get());
    }

    public function store(Request $request)
    {
        Gate::forUser(auth('api')->user())
            ->authorize('create', Task::class);

        $validated = $request->validate([
            'titulo' => 'required|string|max:150|unique:tasks,titulo',
            'descripcion' => 'nullable|string',
            'fecha_limite' => 'nullable|date|after:today',
            'category_id' => 'required|exists:categories,id',
        ]);

        $tarea = DB::transaction(function () use ($validated) {
            return Task::create([
                'titulo' => $validated['titulo'],
                'descripcion' => $validated['descripcion'] ?? null,
                'fecha_limite' => $validated['fecha_limite'] ?? null,
                'category_id' => $validated['category_id'],
                'user_id' => auth('api')->id(),
                'estado' => 'pendiente',
            ]);
        });

        $tarea->load(['category', 'user']);

        return (new TaskResource($tarea))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Task $tarea)
    {
        Gate::forUser(auth('api')->user())
            ->authorize('view', $tarea);

        $tarea->load(['category', 'user']);

        return new TaskResource($tarea);
    }

    public function update(Request $request, Task $tarea)
    {
        Gate::forUser(auth('api')->user())
            ->authorize('update', $tarea);

        $validated = $request->validate([
            'titulo' => [
                'sometimes',
                'required',
                'string',
                'max:150',
                Rule::unique('tasks', 'titulo')->ignore($tarea->id),
            ],
            'descripcion' => 'sometimes|nullable|string',
            'fecha_limite' => 'sometimes|nullable|date|after:today',
            'estado' => 'sometimes|required|in:pendiente,en_progreso,completada',
            'category_id' => 'sometimes|required|exists:categories,id',
        ]);

        $tarea->update($validated);
        $tarea->load(['category', 'user']);

        return new TaskResource($tarea);
    }

    public function destroy(Task $tarea)
    {
        Gate::forUser(auth('api')->user())
            ->authorize('delete', $tarea);

        $tarea->delete();

        return response()->noContent();
    }
}
