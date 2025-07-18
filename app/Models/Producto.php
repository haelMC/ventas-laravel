<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    // ✅ Esto permite usar create() con estos campos
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'imagen',
    ];

    // Relación con detalle de ventas
    public function detalleVentas()
    {
        return $this->hasMany(DetalleVenta::class);
    }
}
