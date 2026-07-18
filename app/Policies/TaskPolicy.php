<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    /**
     * Permite ver el listado de tareas a cualquier usuario autenticado.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Permite ver una tarea si el usuario es administrador o dueño de la tarea.
     */
    public function view(User $user, Task $task): bool
    {
        return $user->rol === 'admin' || $user->id === $task->user_id;
    }

    /**
     * Permite crear tareas a cualquier usuario autenticado.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Permite actualizar una tarea si el usuario es administrador o dueño de la tarea.
     */
    public function update(User $user, Task $task): bool
    {
        return $user->rol === 'admin' || $user->id === $task->user_id;
    }

    /**
     * Permite eliminar una tarea si el usuario es administrador o dueño de la tarea.
     */
    public function delete(User $user, Task $task): bool
    {
        return $user->rol === 'admin' || $user->id === $task->user_id;
    }
}
