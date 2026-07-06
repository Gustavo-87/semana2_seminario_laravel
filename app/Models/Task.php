<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    return $query->where('titulo', 'LIKE', "%{$texto}%");
}
}