<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;
    protected $fillable = ['titulo','autor','editorial','edicion','stock'];

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }
}
