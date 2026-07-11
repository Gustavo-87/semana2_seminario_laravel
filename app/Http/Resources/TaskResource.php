<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
            'estado' => $this->estado,
            'fecha_limite' => $this->fecha_limite,
            'categoria' => [
                'id' => $this->category?->id,
                'nombre' => $this->category?->name,
            ],
            'usuario' => [
                'id' => $this->user?->id,
                'nombre' => $this->user?->name,
            ],
            'fecha_creacion' => $this->created_at?->toDateString(),
            'fecha_actualizacion' => $this->updated_at?->toDateString(),
        ];
    }
}
