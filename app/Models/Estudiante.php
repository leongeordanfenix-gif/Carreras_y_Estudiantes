<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Estudiante extends Model {
    protected $fillable = [
        'carrera_id',
        'codigo',
        'nombres_apellidos',
        'email',
        'fecha_nacimiento'
    ];

    public function carrera(): BelongsTo {
        return $this->belongsTo(Carrera::class);
    }
}
