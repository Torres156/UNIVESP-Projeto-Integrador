@extends('admin.dashboard.index')

@section('content')
    <form class='livro mt-1 d-flex w-100 justify-content-center flex-column p-4' autocomplete="off">

        <div class='d-flex row gap-2 w-100 m-0'>
            <div class='col p-0'>
                <label class="form-label" for="name">Nome</label>
                <input class="form-control border-warning" type="text" name="name" maxlength="200" value="{!! $inputs['name'] ?? '' !!}">
            </div>
            <div class='col p-0'>
                <label class="form-label" for="email">Email</label>
                <input class="form-control border-warning" type="text" name="email" maxlength="200"
                    autocomplete="new-password" value="{!! $inputs['email'] ?? '' !!}">
            </div>
            <div class='col p-0'>
                <label class="form-label" for="acesso">Acesso</label>
                <select class="form-control border-warning" list="categories" type="text" name="acesso" placeholder=""
                    maxlength="100" autocomplete="new-password">
                    <option value="" {{ isset($inputs['acesso']) &&  $inputs['acesso'] === '' ? '' : 'selected' }}>Nenhum</option>
                    <option value="0" {{ isset($inputs['acesso']) && $inputs['acesso'] == 0 ? 'selected' : '' }}>Secretário</option>
                    <option value="1" {{ isset($inputs['acesso']) && $inputs['acesso'] == 1 ? 'selected' : '' }}>Administrador</option>
                </select>
            </div>
        </div>

        <button class="btn btn-primary mt-2 col-3 ml-3" type="submit">Filtrar</button>
    </form>

    <section class="livro p-4 mt-2 d-flex w-100 pt-0 ">
        <table class="table table-hover table-responsive">
            <thead class="sticky-top">
                <tr>
                    <th scope="col" class="col-2">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Acesso</th>
                    <th scope="col" class='col-2'>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario )
                <tr>
                    <th scope="row">{{ $usuario->id}}</th>
                    <td>{{ $usuario->name}}</td>
                    <td>{{ $usuario->email}}</td>
                    <td>{{ $usuario->acesso === 0 ? 'Secretário' : 'Administrador' }}</td>
                    <td >
                        <div class="d-flex w-100 flex-row">
                        <a class="action d-flex h-100" href="{{route('admin.usuario.editar', ['id' => $usuario->id])}}"><i class='bx bx-pencil'></i></a>
                        <a class="action d-flex text-danger"><i class='bx bx-x'></i></a>
                        </div>
                    </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
    </section>
@endsection
