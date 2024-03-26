<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php
    $title = 'Teste';
@endphp
@include('includes.head')

<body class="antialiased bg-secondary bg-gradient max-w d-flex justify-content-center align-items-center" style="height: 100vh">
    <div class="card border-warning d-flex white shadow-lg " style="width: 50%; height:50%">'
       <div class="d-flex justify-content-end">
            <img src="assets/img/logo.png" width="100">
       </div>
       <div class="d-flex justify-content-center align-items-center">
       <form class="w-50 mt-1" autocomplete="off">
        <div>
            <label class="form-label" for="usuario">Usuario ou Email</label>
            <input class="form-control border-warning" type="text" name="usuario" placeholder="Digite seu usuario ou email" autocomplete="new-password">
        </div>

        <div class="mt-4">
            <label class="form-label" for="senha">Senha</label>
            <input class="form-control border-warning" type="password" name="senha" placeholder="Digite sua senha" autocomplete="new-password">
        </div>
        <div class="d-flex justify-content-center">
        <button class="btn btn-primary mt-3">Entrar</button>
        </div>
        </form>        
       </div>
    </div>

</body>

</html>
