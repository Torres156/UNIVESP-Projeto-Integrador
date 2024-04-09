@extends('admin.dashboard.index')

@section('content')
    <form class='livro mt-1 d-flex w-100 justify-content-center flex-column p-4' autocomplete="off" method="POST">
        @csrf

        <div class='d-flex row gap-2 w-100 m-0'>
            <div class='col p-0'>
                <label class="form-label" for="aluno">Aluno</label>
                <select class="form-control border-warning" type="text" name="aluno" onchange="PegarLivros(event)"
                    required>
                    <option hidden value="">Selecione</option>
                    @if (isset($alunos) && count($alunos) > 0)                        
                        @foreach ($alunos as $aluno)
                            <option value="{{ $aluno->id }}">{!! $aluno->nome . ' - RA:' . $aluno->ra !!}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        <div class='d-flex row gap-2 w-100 m-0 mt-2'>
            <div class='col p-0'>
                <label class="form-label" for="livro">Livro</label>
                <select class="form-control border-warning" type="text" name="livro" id="livros" required>
                    <option hidden value="" selected>Selecione</option>
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

        </div>

        <button class="btn btn-primary mt-2 col-3 ml-3" type="submit">Salvar</button>
    </form>
    <script>
        function PegarLivros(event) {
            const value = event.target.value;
            let url = `{{ route('admin.devolucao.livros', ['id' => 'ZERO']) }}`;
            url = url.replace('ZERO', value);
            fetch(url).then(res => res.text()).then(res => {
                const livros = document.getElementById("livros");
                livros.innerHTML = res;
            });
        }
    </script>
@endsection
