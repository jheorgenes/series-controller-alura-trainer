<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Season;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EpisodesController extends Controller
{
    public function index(Season $season)
    {
        return view('episodes.index', [
            'episodes' => $season->episodes,
            'mensagemSucesso' => session('mensagem.sucesso')
        ]);
    }

    public function update(Request $request, Season $season)
    {
        $watchedEpisodes = implode(', ', $request->episodes ?? []);

        // Se o array de episodes estiver vazio
        if(empty($watchedEpisodes)) {
            DB::transaction(function () use ($season) {
                $season->episodes()->update(['watched' => false]);
            });

            return to_route('episodes.index', $season->id);
        }

        DB::transaction(function () use ($season, $watchedEpisodes) {
            $season->episodes()->update([
                // Validando se o episódio foi marcado como visto
                'watched' => DB::raw("case when id in ($watchedEpisodes) then true else false end")
            ]);
        });

        /**
         * Outro jeito de fazer
         *
         * Aqui não foi utilizado arrow funcions, porque as arrow functions retornam o valor da expressão que foi utilizada nela
         * Isso é um problema porque o método each vai ser interrompido se a função passada pra ele retornar false.
         * Então quando nós tivéssemos o primeiro episódio que tivesse watched = false, esse valor seria retornado e o loop se encerraria.
         */
        // $watchedEpisodes = $request->episodes;
        // $season->episodes()->each(function (Episode $episode) use ($watchedEpisodes) {
        //     $episode->watched = in_array($episode->id, $watchedEpisodes);
        // });

        // $season->push(); //Salva a model em questão e rodos os seus relacionamentos

        return to_route('episodes.index', $season->id)
            ->with('mensagem.sucesso', 'Episódios marcados como assistidos!');
    }
}
