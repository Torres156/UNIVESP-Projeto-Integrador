@extends('admin.dashboard.index')

@section('content')
    <div class="inicio p-2">
        @if ($atrasados > 0)
            <div id="alert" class="alert alert-warning fade show" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img"
                    aria-label="Warning:">
                    <path
                        d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </svg>
                Existem alguns alunos atrasados para devolução de livro.
                <button type="button" class="btn btn_close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
        @endif


        <section class="emprestimos mt-2 border">
            <table class="table table-hover table-responsive ">
                <thead class="sticky-top">
                    <tr>
                        <th scope="col" class="col">Livro</th>
                        <th scope="col">Aluno</th>
                        <th scope="col" class="col-2">Sala</th>
                        <th scope="col" class='col-2'>Empréstimo</th>
                        <th scope="col" class='col-2'>Devolução</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($emprestimos as $emprestimo)
                        <tr  {!! $emprestimo->atrasado === 1 ? 'class="text-danger" data-bs-toggle="popover" data-bs-custom-class="custom-popover" data-bs-trigger="hover" data-bs-content="Aluno atrasado"' : '' !!} >
                            <td>{{ $emprestimo->livro }}</th>
                            <td>{{ $emprestimo->aluno }}</td>
                            <td>{{ $emprestimo->sala }}</td>
                            <td>{{ date('d/m/Y', strtotime($emprestimo->emprestimo)) }}</td>
                            <td>{{ date('d/m/Y', strtotime($emprestimo->devolucao)) }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </section>

        <div class="relatorios m-0 mt-4 row gap-4 w-100 justify-content-center">
            <div class="card col p-0">
                <h3>Total Livros</h3>
                <h2 class="text-primary">{{ $livros }}</h2>
            </div>
            <div class="card col p-0">
                <h3>Emprestados</h3>
                <h2 class="text-success">{{ $emprestados}}</h2>
            </div>
            <div class="card col p-0">
                <h3>Atrasados</h3>
                <h2 class="text-danger">{{ $atrasados}}</h2>
            </div>

        </section>
    </div>

    <script>
        document.querySelector('.btn_close').addEventListener('click', () => {
            const element = document.getElementById('alert');
            element.classList.remove('show');
        });
    </script>
@endsection
