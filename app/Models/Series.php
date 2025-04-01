<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'cover'];

    public function seasons()
    {
        return $this->hasMany(Season::class, 'series_id');
    }

    public function episodes()
    {
        // Busca todos os episódios da serie com base no relacionamento entre episódios e seasons
        return $this->hasManyThrough(Episode::class, Season::class);
    }

    // Ordenamento Global por Escopo
    protected static function booted()
    {
        self::addGlobalScope('ordered', function (Builder $queryBuilder) {
            $queryBuilder->orderBy('nome');
        });
    }
}
