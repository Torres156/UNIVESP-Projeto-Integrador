@extends('admin.dashboard.index')

@section('content')
    <form class='livro mt-1 d-flex w-100 justify-content-center flex-column p-4' autocomplete="off" method="POST">
        @csrf        
        <div class='d-flex row gap-2 w-100 m-0'>
            <div class='col p-0'>
                <label class="form-label" for="nome">Nome</label>
                <input class="form-control border-warning" type="text" name="nome" maxlength="200" autocomplete="new-password" value="{{ $usuario->name }}" required>
            </div>
        </div>

        <div class='d-flex row gap-2 w-100 m-0 mt-2'>
            <div class='col p-0'>
                <label class="form-label" for="email">Email</label>
                <input class="form-control border-warning" type="email" name="email" maxlength="200" autocomplete="new-password" value="{{ $usuario->email }}" required>
            </div>
        </div>

        <div class='d-flex row gap-2 w-100 m-0 mt-2'>
            <div class='col p-0'>
                <label class="form-label" for="senha">Senha <span class="text-danger" style="font-size: 11px">* Deixe em branco para não alterar a senha</span></label>
                <input class="form-control border-warning" type="password" name="senha" minlength="4" maxlength="40" autocomplete="false">
            </div>

            <div class='col p-0'>
                <label class="form-label" for="acesso">Nivel de acesso</label>
                <select class="form-control border-warning" type="text" name="acesso" required>
                    <option value="0" {{ $usuario->acesso === 0 ? 'selected' : '' }}>Secretário</option>
                    <option value="1" {{ $usuario->acesso === 1 ? 'selected' : '' }}>Administrador</option>
                </select>
            </div>
        </div>

        <button class="btn btn-primary  m-auto mt-4 col-3" type="submit">Salvar</button>
    </form>
@endsection
