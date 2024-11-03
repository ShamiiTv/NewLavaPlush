<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngresoExterno extends Model
{
    use HasFactory;

    protected $fillable = ['tipo_ropa', 'tipo_ropa_detalle', 'cantidad', 'user_id'];
    protected $table = 'ingresoexterno';


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
