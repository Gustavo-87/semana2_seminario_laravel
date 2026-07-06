<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\Category;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
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

    $tareas = $query->orderBy('created_at', 'desc')->get();

    return view('tareas.index', compact('tareas'));
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Category::all();

    return view('tareas.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $request->validate([
        'titulo' => 'required|string|max:150',
        'descripcion' => 'nullable|string',
        'fecha_limite' => 'nullable|date',
        'estado' => 'required|in:pendiente,en_progreso,completada',
        'category_id' => 'required|exists:categories,id',
    ]);

    $data = $request->all();
    $data['user_id'] = 1;

    Task::create($data);

    return redirect()->route('tareas.index')->with('success', 'Tarea creada exitosamente.');
}

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
