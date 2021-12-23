<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
