<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;
    protected $fillable = ['number'];
    public $timestamps = false;
    protected $casts = [
        'watched' => 'boolean'
    ];

    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    // /**
    //  * 
    //  *  Mutators e Castings do atributo watched
    //  * 
    //  */
    // protected function watched(): Attribute
    // {
    //     // Transformando o atributo para sempre retornar booleano mesmo ao invés de um int.
    //     return new Attribute(
    //         get: fn($watched) => (bool) $watched,
    //         set: fn($watched) => (bool) $watched
    //     );
    // }
}
