@extends('admin.dashboard.index')

@section('content')
    <form class='livro mt-1 d-flex w-100 justify-content-center flex-column p-4' autocomplete="off">

        <div class='d-flex row gap-2 w-100 m-0'>
            <div class='col col-2 p-0'>
                <label class="form-label" for="codigo">Código</label>
                <input class="form-control border-warning" type="text" name="codigo" maxlength="10" data-input-number value="{!! $inputs['codigo'] ?? '' !!}">
            </div>
            <div class='col col-2 p-0'>
                <label class="form-label" for="isbn">ISBN</label>
                <input class="form-control border-warning" type="text" name="isbn" maxlength="10"
                    autocomplete="new-password" data-input-number value="{!! $inputs['isbn'] ?? '' !!}">
            </div>
            <div class='col p-0'>
                <label class="form-label" for="nome">Nome</label>
                <input class="form-control border-warning" type="text" name="nome" placeholder="" maxlength="100"
                    autocomplete="new-password" value="{!! $inputs['nome'] ?? '' !!}">
            </div>
            <div class='col p-0'>
                <label class="form-label" for="categoria">Categoria</label>
                <select class="form-control border-warning" list="categories" type="text" name="categoria" placeholder=""
                    maxlength="100" autocomplete="new-password">
                    <option value="" {{ isset($inputs['categoria']) &&  !empty($inputs['categoria']) ? '' : 'selected' }}>Nenhum</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat }}" {{ isset($inputs['categoria']) && $cat === $inputs['categoria'] ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <button class="btn btn-primary mt-2 col-3 ml-3" type="submit">Filtrar</button>
    </form>

    <section class="livro p-4 mt-2 d-flex w-100 overflow-auto">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" class="col-2">#</th>
                    <th scope="col">Livro</th>
                    <th scope="col" class="col-2">ISBN</th>
                    <th scope="col" class='col-2'>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($livros as $livro )
                <tr>
                    <th scope="row">{{ $livro->id}}</th>
                    <td>{{ $livro->nome}}</td>
                    <td>{{ !isset($livro->isbn) || empty($livro->isbn) ? '(None)' : $livro->isbn}}</td>
                    <td >
                        <div class="d-flex w-100 flex-row">
                        <a class="action d-flex h-100" href="{{route('admin.livro.editar', ['id' => $livro->id])}}"><i class='bx bx-pencil'></i></a>
                        <a class="action d-flex text-danger"><i class='bx bx-x'></i></a>
                        </div>
                    </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
    </section>
@endsection
