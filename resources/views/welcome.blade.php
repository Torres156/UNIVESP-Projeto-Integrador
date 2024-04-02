<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php
    $title = 'Teste';
@endphp
@include('includes.head')

<body class="antialiased bg-secondary bg-white max-w d-flex justify-content-center align-items-center" style="height: 100vh">
    <div class="card border-warning d-flex white shadow-lg w-100" style="max-width: 600px; height: 500px">
       <div class="d-flex justify-content-around p-5 hstack gap-5">
        <h2 class="p-1 border border-dark p-1 bg-warning rounded-2 ">Biblioteca Legal</h2>
        <img class="float-right" src="assets/img/bibliotecalegal2.png" width="180">
       </div>
       <div class="d-flex justify-content-center align-items-center">
       <form class="w-50 mt-0" autocomplete="off">
        <div>
            <label class="form-label" for="usuario">Usuário ou Email</label>
            <input class="form-control border-warning" type="text" name="usuario" placeholder="Digite seu usuario ou email" autocomplete="new-password">
        </div>

        <div class="mt-4">
            <label class="form-label" for="senha">Senha</label>
            <input class="form-control border-warning" type="password" name="senha" placeholder="Digite sua senha" autocomplete="new-password">
        </div>
        <div class="d-flex justify-content-center">
        <button class="btn btn-primary mt-5">Entrar</button>
        </div>
        </form>        
       </div>
    </div>

</body>

</html>
