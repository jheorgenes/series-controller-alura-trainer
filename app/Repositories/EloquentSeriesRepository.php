<?php

namespace App\Repositories;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use Illuminate\Support\Facades\DB;

class EloquentSeriesRepository implements SeriesRepository
{
    public function add(SeriesFormRequest $request): Series
    {
        return DB::transaction(function () use ($request) {
            $serie = Series::create($request->all());

            $seasons = [];
            // Percorrendo a quantidade de temporadas
            for($i = 1; $i <= $request->seasonsQty; $i++){
                // Gerando um array multidimensional
                $seasons[] = [
                    'series_id' => $serie->id,
                    'number' => $i,
                ];
            }
            Season::insert($seasons); //Inserindo todas as series declaradas de uma vez

            $episodes = [];
            // Percorrendo a quantidade de episódios por temporada
            foreach($serie->seasons as $season) {
                for($j = 1; $j <= $request->episodesPerSeason; $j++){
                    $episodes[] = [
                        'season_id' => $season->id,
                        'number' => $j
                    ];
                }
            }
            Episode::insert($episodes); //Inserindo todos os episódios declarados de uma vez

            return $serie;
        });
    }
}
