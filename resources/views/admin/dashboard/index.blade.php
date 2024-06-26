<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php
    $css = 'admin';
@endphp
@include('includes.head')
@include('includes.scripts')

<body class="antialiased bg-secondary bg-white d-flex justify-content-center align-items-center">
    <main class="card border-warning d-flex white shadow-lg w-100 flex-row">
        <nav class="navbar border-warning">
            <ul class ="nav navbar-nav">
                <li class ="nav-item">
                    <a class ="nav-link fw-bold" href="{{ route('admin.dashboard') }}">Início</a>
                </li>

                <li class ="nav-item">
                    <a class ="nav-link fw-bold" href="{{ route('admin.aluno.cadastro') }}">Cadastro Aluno</a>
                    <a class ="nav-link pt-0" href="{{ route('admin.aluno.index') }}">Lista de Alunos</a>
                    <a class ="nav-link pt-0" href="{{ route('admin.aluno.ranking') }}">Ranking</a>
                </li>

                <li class ="nav-item">
                    <a class ="nav-link fw-bold pb-0" href="{{ route('admin.livro.cadastro') }}">Cadastro Livro</a>
                    <a class ="nav-link pt-0" href="{{ route('admin.livro') }}">Lista de Livros</a>
                </li>

                <li class ="nav-item">
                    <a class ="nav-link fw-bold" href="{{ route('admin.emprestimo') }}">Empréstimo</a>
                </li>

                <li class ="nav-item">
                    <a class ="nav-link fw-bold" href="{{ route('admin.devolucao') }}">Devolução</a>
                </li>

                @if (auth()->user()->acesso === 1)
                    <li class ="nav-item">
                        <a class ="nav-link fw-bold" href="{{ route('admin.usuario.cadastro') }}">Cadastro Usuario</a>
                        <a class ="nav-link pt-0" href="{{ route('admin.usuario') }}">Lista de Usuarios</a>
                    </li>
                @endif

                <li class ="nav-item">
                    <a class ="nav-link fw-bold" href="{{ route('admin.logout') }}">Sair</a>
                </li>
            </ul>
        </nav>
        <div class="d-flex w-100 flex-column">
            @include('admin.dashboard.includes.header')
            @yield('content')
        </div>
    </main>
</body>

@if ($errors->any())
    <script>
        const errors = `{!! implode('<br>', $errors->all()) !!}`;
        Swal.fire({
            title: 'Ops! Aconteceu algo errado.',
            html: errors,
            icon: 'error',
            confirmButtonText: 'OK',
            heightAuto: false,
        })
    </script>
@endif

@if (Session::has('success'))
    <script>
        const message = `{!! Session::get('success') !!}`;
        Swal.fire({
            title: '',
            html: message,
            icon: 'success',
            confirmButtonText: 'OK',
            heightAuto: false,
        })
    </script>
    @php
    @endphp
@endif

</html>
