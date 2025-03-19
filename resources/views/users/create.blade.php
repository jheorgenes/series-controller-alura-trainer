<x-layout title="Novo usuário">
    <form method="post" class="mt-2">
        @csrf

        <div class="form-group">
            <label for="name" class="form-label">Nome</label>
            <input type="name" class="form-control" name="name" id="name">
        </div>

        <div class="form-group">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" name="email" id="email">
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Senha</label>
            <input type="password" class="form-control" name="password" id="password">
        </div>

        <button class="btn btn-primary mt-3">Entrar</button>
    </form>
</x-layout>
