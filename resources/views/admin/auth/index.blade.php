<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php
    $title = 'Login';
    $css = 'auth';
@endphp
@include('includes.head')
@include('includes.scripts')

<body class="antialiased bg-secondary bg-white max-w d-flex justify-content-center align-items-center"
    style="height: 100vh !important">
    <main class=" card border-warning d-flex white shadow-lg w-100">

        <!-- Logo -->
        <div class="d-flex justify-content-around p-5 hstack gap-5">
            <img class="float-right" src="{{asset('assets/img/bibliotecalegal2.png')}}" width="180">
        </div>

        <!-- Formulario -->
        <div class="d-flex justify-content-center align-items-center">
            <form class="mt-0" autocomplete="off" method="POST">
                @csrf
                <div>
                    <label class="form-label" for="usuario">Usuário ou Email</label>
                    <input class="form-control border-warning" type="email" name="usuario"
                        placeholder="Digite seu usuario ou email" autocomplete="new-password" required>
                </div>

                <div class="mt-4">
                    <label class="form-label" for="senha">Senha</label>
                    <input class="form-control border-warning" type="password" name="senha"
                        placeholder="Digite sua senha" autocomplete="new-password" required>
                </div>
                <div class="d-flex justify-content-center">
                    <button class="btn btn-primary mt-5">Entrar</button>
                </div>
            </form>
        </div>
    </main>
</body>
@if ($errors->any())
<script>
    const errors =  `{!! implode("<br>", $errors->all() ) !!}`;
    Swal.fire({
        title: 'Ops! Aconteceu algo errado.',        
        html: errors,
        icon: 'error',
        confirmButtonText: 'OK',
        heightAuto: false,
    })
</script>
@endif

</html>
