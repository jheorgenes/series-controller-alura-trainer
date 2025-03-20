<x-layout title="Temporadas de {!! $serie->nome !!}">
    <div class="text-center d-flex justify-center">
        <img src="{{ asset('storage/' . $serie->cover) }}"
            alt="Capa da série {{ $serie->nome }}"
            style="height: 400px"
            class="img-fluid mb-3">
    </div>
    <ul class="list-group">
        @foreach ($seasons as $season)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <a href="{{ route('episodes.index', [$season->id]) }}">
                Temporada {{ $season->number }}
            </a>

            <span class="badge bg-secondary">
                {{-- {{ $season->episodes()->watched()->count() }} / {{ $season->episodes->count() }} --}}
                {{ $season->numberOfWatchedEpisodes() }} / {{ $season->episodes->count() }}
            </span>
        </li>
        @endforeach
    </ul>
</x-layout>
