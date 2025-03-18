<x-layout title="Editar Série '{{ $serie->nome }}'">
    <x-series.form :action="route('series.update', $serie->id)" :update="true"/>
</x-layout>
