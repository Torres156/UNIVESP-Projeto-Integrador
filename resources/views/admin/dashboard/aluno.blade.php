@extends('admin.dashboard.index')

@section('content')
    <form class='aluno mt-1 d-flex w-100 justify-content-center flex-column p-4' autocomplete="off" method="POST">
        @csrf
        <div class='d-flex row gap-2 w-100'>
            <div class='col'>
                <label class="form-label" for="nome">Nome do Aluno*</label>
                <input class="form-control border-warning" type="text" name="nome" placeholder="Digite o nome do aluno"
                    maxlength="40" autocomplete="new-password" required>
            </div>
            <div class='col ra'>
                <label class="form-label" for="ra">RA*</label>
                <input class="form-control border-warning" type="text" name="ra" placeholder="Digite o RA"
                    minlength="8" maxlength="8" required data-input-number>
            </div>
        </div>

        <div class='d-flex row gap-2 w-100 mt-3'>
            <div class='col'>
                <label class="form-label" for="email">Email</label>
                <input class="form-control border-warning" type="email" name="email"
                    placeholder="Digite o email do aluno" maxlength="40">
            </div>
        </div>

        <div class='d-flex row gap-2 w-100 mt-3'>
            <div class='col'>
                <label class="form-label" for="nascimento">Data de nascimento*</label>
                <input class="form-control border-warning" type="date" min="1950-12-31" name="nascimento" placeholder=""
                    onblur="changeBirthday(event)" required>
            </div>

            <div class='col'>
                <label class="form-label" for="idade">Idade</label>
                <input readonly class="form-control border-warning " type="text" id='idade' name="idade" placeholder="" >
            </div>
        </div>

        <div class='d-flex row gap-2 w-100 mt-3'>
            <div class='col'>
                <label class="form-label" for="telefone">Telefone</label>
                <input class="form-control border-warning" type="text" name="telefone" placeholder="Digite o telefone" maxlength="15" data-input-phone >
            </div>
            <div class='col'>
                <label class="form-label" for="sala">Sala*</label>
                <select class="form-control border-warning" type="text" name="sala" required>
                    <option hidden value="">Selecione</option>
                    @foreach ($salas as $sala)
                        <option value="{{ $sala }}">{{ $sala }}</option> 
                    @endforeach                    
                </select>
            </div>
        </div>

        <button class="btn btn-primary mt-4" type="submit">Gravar</button>
    </form>
@endsection