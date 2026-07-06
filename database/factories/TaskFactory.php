<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'titulo' => $this->faker->sentence(),
            'descripcion' => $this->faker->paragraph(),
            'fecha_limite' => $this->faker->dateTimeBetween('now', '+3 months'),
            'estado' => $this->faker->randomElement(['pendiente', 'en progreso', 'completada']),
            'category_id' => Category::factory(),
        ];
    }
}