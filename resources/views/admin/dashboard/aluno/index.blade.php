@extends('admin.dashboard.index')

@section('content')
    <form class='livro mt-1 d-flex w-100 justify-content-center flex-column p-4' autocomplete="off">

        <div class='d-flex row gap-2 w-100 m-0'>
            <div class='col col p-0'>
                <label class="form-label" for="nome">Nome</label>
                <input class="form-control border-warning" type="text" name="nome" maxlength="100" value="{!! $inputs['nome'] ?? '' !!}">
            </div>
            <div class='col col-3 p-0'>
                <label class="form-label" for="ra">RA</label>
                <input class="form-control border-warning" type="text" name="ra" maxlength="8"
                    autocomplete="new-password" data-input-number value="{!! $inputs['ra'] ?? '' !!}">
            </div> 
        </div>

        <button class="btn btn-primary mt-2 col-3 ml-3" type="submit">Filtrar</button>
    </form>

    <section class="livro p-4 mt-2 d-flex w-100 pt-0 ">
        <table class="table table-hover table-responsive">
            <thead class="sticky-top">
                <tr>
                    <th scope="col" class="col-2">#</th>
                    <th scope="col">Aluno</th>
                    <th scope="col" class="col-2">RA</th>
                    <th scope="col" class='col-2'>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alunos as $aluno )
                <tr>
                    <th scope="row">{{ $aluno->id}}</th>
                    <td>{{ $aluno->nome}}</td>
                    <td>{{ $aluno->ra}}</td>
                    <td >
                        <div class="d-flex w-100 flex-row">
                        <a class="action d-flex h-100" href="{{route('admin.aluno.editar', ['id' => $aluno->id])}}"><i class='bx bx-pencil'></i></a>
                        <a class="action d-flex text-danger"><i class='bx bx-x'></i></a>
                        </div>
                    </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
    </section>
@endsection
