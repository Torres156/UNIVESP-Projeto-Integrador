@extends('admin.dashboard.index')

@section('content')
    <form class='livro mt-1 d-flex w-100 justify-content-center flex-column p-4' autocomplete="off" method="POST">
        @csrf

        <div class='d-flex row gap-2 w-100 m-0'>
            <div class='col p-0'>
                <label class="form-label" for="aluno">Aluno</label>
                <select class="form-control border-warning" type="text" name="aluno" required>
                    <option hidden value="">Selecione</option>
                    @foreach ($alunos as $aluno)
                    <option value="{{$aluno->id}}">{!! $aluno->nome . ' - RA:' . $aluno->ra !!}</option>
                    @endforeach
                </select>
            </div>          
        </div>

        <div class='d-flex row gap-2 w-100 m-0 mt-2'>
            <div class='col p-0'>
                <label class="form-label" for="livro">Livro</label>
                <select class="form-control border-warning" type="text" name="livro" required>
                    <option hidden value="">Selecione</option>
                    @foreach ($livros as $livro)
                    <option value="{{$livro->id}}">{!! $livro->nome . ' - ' . $livro->id !!}</option>
                    @endforeach
                </select>
            </div>          
        </div>

        <div class='d-flex row gap-2 w-100 m-0 mt-2'>
            <div class='col p-0'>
                <label class="form-label" for="estado">Estado do livro</label>
                <select class="form-control border-warning" type="text" name="estado" required>
                    <option hidden value="">Selecione</option>
                    <option value="Novo">Novo</option>
                    <option value="Bom">Bom</option>
                    <option value="Danificado">Danificado</option>
                </select>
            </div>   
            
            <div class='col p-0'>
                <label class="form-label" for="devolucao">Devolução</label>
                <input class="form-control border-warning" id="devolucao" type="date" name="devolucao" value="{{date('Y-m-d') }}" required>                    
            </div>
        </div>

        <button class="btn btn-primary mt-2 col-3 ml-3" type="submit">Salvar</button>
    </form>    
    <script>
        const devolucao = document.getElementById('devolucao');
        devolucao.min="{{ date('Y-m-d') }}";
        devolucao.max = "{!! date('Y-m-d',strtotime('now +3 week'))!!}";
    </script>
@endsection
