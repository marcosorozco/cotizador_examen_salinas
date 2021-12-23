<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Plazo extends Model
{
    protected $table = 'plazos';

    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
