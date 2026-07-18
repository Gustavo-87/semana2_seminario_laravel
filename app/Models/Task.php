<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'fecha_limite',
        'estado',
        'user_id',
        'category_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeCompletadas($query)
    {
        return $query->where('estado', 'completada');
    }

    public function scopePendientes($query)
    {
        return $query->where('estado', '!=', 'completada');
    }

    public function scopeBuscar($query, $texto)
    {
        if (empty($texto)) {
            return $query;
        }

        return $query->where('titulo', 'LIKE', "%{$texto}%");
    }

    public function scopeFiltrarEstado($query, $estado)
    {
        if (empty($estado)) {
            return $query;
        }

        return $query->where('estado', $estado);
    }

    public function scopeFiltrarCategoria($query, $categoriaId)
    {
        if (empty($categoriaId)) {
            return $query;
        }

        return $query->where('category_id', $categoriaId);
    }

    public function scopeFechas($query, $fechaInicio, $fechaFin)
    {
        if (! empty($fechaInicio)) {
            $query->whereDate('fecha_limite', '>=', $fechaInicio);
        }

        if (! empty($fechaFin)) {
            $query->whereDate('fecha_limite', '<=', $fechaFin);
        }

        return $query;
    }
}
