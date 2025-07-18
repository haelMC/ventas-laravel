<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Venta extends Model
{
    protected $fillable = ['user_id', 'total'];

    public function detalles(): HasMany
    {
        return $this->hasMany(DetalleVenta::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
