<x-layout title="Editar Série '{!! $serie->nome !!}'"><!-- Evitando duplo encoder de html -->
    <x-series.form :action="route('series.update', $serie->id)" :update="true"/>
</x-layout>
