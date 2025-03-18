<form action="{{ $action }}" method="POST">
    @csrf

    <!-- Verifica se há o atributo :update='true' na view (create ou edit) que enviou a informação.. Se tiver, será inserido nesse formulário o method PUT -->
    @isset($update)
    @method('PUT')
    @endisset

    <div class="mb-3">
        <label for="nome" class="form-label">Nome:</label>
        <input
            type="text"
            id="nome"
            name="nome"
            class="form-control"
            @isset($nome)value="{{ $nome }}"@endisset>
    </div>
    <input type="submit" value="Adicionar" class="btn btn-primary">
</form>
