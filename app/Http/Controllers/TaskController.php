<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize('viewAny', Task::class);

        $query = Task::with(['user', 'category']);

        if ($request->filled('buscar')) {
            $query->buscar($request->buscar);
        }

        if ($request->filled('estado')) {
            if ($request->estado == 'completada') {
                $query->completadas();
            } else {
                $query->pendientes();
            }
        }

        $tareas = $query->orderBy('created_at', 'desc')
            ->paginate(15)
            ->withQueryString();

        return view('tareas.index', compact('tareas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Task::class);

        $categorias = Category::all();

        return view('tareas.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Task::class);

        $validated = $request->validate([
            'titulo' => 'required|string|max:150|unique:tasks,titulo',
            'descripcion' => 'nullable|string',
            'fecha_limite' => 'nullable|date',
            'estado' => 'required|in:pendiente,en_progreso,completada',
            'category_id' => 'required|exists:categories,id',
        ]);

        Task::create($validated + [
            'user_id' => auth()->id(),
        ]);

        return redirect()
            ->route('tareas.index')
            ->with('success', 'Tarea creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $tarea)
    {
        Gate::authorize('view', $tarea);

        return redirect()->route('tareas.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $tarea)
    {
        Gate::authorize('update', $tarea);

        $categorias = Category::orderBy('name')->get();

        return view('tareas.edit', compact('tarea', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $tarea)
    {
        Gate::authorize('update', $tarea);

        $validated = $request->validate([
            'titulo' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
            'fecha_limite' => 'nullable|date',
            'estado' => 'required|in:pendiente,en_progreso,completada',
            'category_id' => 'required|exists:categories,id',
        ]);

        $tarea->update($validated);

        return redirect()
            ->route('tareas.index')
            ->with('success', 'Tarea actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $tarea)
    {
        Gate::authorize('delete', $tarea);

        $tarea->delete();

        return redirect()
            ->route('tareas.index')
            ->with('success', 'Tarea eliminada correctamente.');
    }
}
