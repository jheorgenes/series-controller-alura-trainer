<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Autenticador;
use App\Http\Requests\SeriesFormRequest;
use App\Events\SeriesCreated as SeriesCreatedEvent;
use App\Jobs\DeleteSeriesCover;
use App\Models\Series;
use App\Models\User;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $repository)
    {
        $this->middleware(Autenticador::class)->except(['index']);
    }

    public function index(Request $request)
    {
        $series = Series::all();
        // $series = Serie::with(['temporadas'])->get();
        $mensagemSucesso = session('mensagem.sucesso');
        return view('series.index')
            ->with('series', $series)
            ->with('mensagemSucesso', $mensagemSucesso);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
    {
        $coverPath = $request
            ->file('cover')
            ->store('series_cover', 'public');

        // Gambiarra pra adicionar o caminho da imagem ao request (OBS: Criar novo SeriesFormRequest com validação pra isso)
        $request->coverPath = $coverPath;

        $serie = $this->repository->add($request);

        // Usando o Dispath pega todos os parametros definidos no construtor da classe do evento.
        SeriesCreatedEvent::dispatch(
            $serie->nome,
            $serie->id,
            $request->seasonsQty,
            $request->episodesPerSeason,
        );

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$serie->nome}' adicionada com sucesso!"); //Redirect com flash message
    }

    public function edit(Series $series)
    {
        return view('series.edit')->with('serie', $series);
    }

    public function update(Series $series, SeriesFormRequest $request)
    {
        $series->nome = $request->nome;
        $series->save();
        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$series->nome}' atualizada com sucesso!");
    }

    public function destroy(Series $series)
    {

        $series->delete();

        if($series->cover){
            DeleteSeriesCover::dispatch($series->cover);
        }

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série {$series->nome} removida com sucesso!");
    }
}
