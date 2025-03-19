<x-layout title="Login">
    <form method="post" class="mt-2">
        @csrf

        <div class="form-group">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" name="email" id="email">
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Senha</label>
            <input type="password" class="form-control" name="password" id="password">
        </div>

        <button class="btn btn-primary mt-3">Entrar</button>

        <a href="{{ route('users.create') }}" class="btn btn-secondary mt-3">Registrar</a>
    </form>
</x-layout>
