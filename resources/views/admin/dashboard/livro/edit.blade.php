@extends('admin.dashboard.index')

@section('content')
    <form class='livro mt-1 d-flex w-100 justify-content-center flex-column p-4' autocomplete="off" method="POST" enctype="multipart/form-data">
        @csrf
        <div class='d-flex row gap-2 w-100 m-0'>
            <div class='col col-2'>
                <label class="form-label" for="codigo">#Código</label>
                <input class="form-control border-warning" type="text" name="codigo" readonly value="{{$livro->id}}" required>
            </div>
            <div class='col col-2'>
                <label class="form-label" for="isbn">ISBN</label>
                <input class="form-control border-warning" type="text" name="isbn" maxlength="10" autocomplete="new-password" value="{{$livro->isbn}}">
            </div>
            <div class='col'>
                <label class="form-label" for="localizacao">Localização/Prateleira</label>
                <input class="form-control border-warning" type="text" name="localizacao" placeholder="Digite a localização do livro" maxlength="100" autocomplete="new-password" value="{{$livro->localizacao}}">
            </div>           
        </div>     
        
        <div class='d-flex row gap-2 w-100 m-0 mt-3'>
            <div class='col'>
                <label class="form-label" for="nome">Livro*</label>
                <input class="form-control border-warning" type="text" name="nome" maxlength="100" required autocomplete="new-password" value="{{$livro->nome}}">
            </div>
            <div class='col'>
                <label class="form-label" for="autor">Autor*</label>
                <input class="form-control border-warning" type="text" name="autor" placeholder="Digite o nome do autor" maxlength="100" autocomplete="new-password" value="{{$livro->autor}}">
            </div>
        </div> 

        <div class='d-flex row gap-2 w-100 m-0 mt-3'>
            <div class='col'>
                <label class="form-label" for="categoria">Categoria / Tema</label>
                <input class="form-control border-warning" list="categories" type="text" name="categoria" maxlength="100" multiple='multiple' value="{{$livro->categoria}}">

                <datalist id='categories'>
                    @foreach ($categories as $cat)
                    <option value="{{$cat}}"></option>
                    @endforeach
                </datalist>
            </div>
            <div class='col col-3'>
                <label class="form-label" for="faixa_etaria">Faixa Etária*</label>
                <input class="form-control border-warning" name="faixa_etaria" value=1 maxlength="2" autocomplete="new-password" required data-input-number value="{{$livro->faixa_etaria}}">
            </div>

            <div class='col'>
                <label class="form-label" for="editora">Editora</label>
                <input class="form-control border-warning" name="editora" maxlength="50" autocomplete="new-password" value="{{$livro->editora}}">
            </div>
        </div> 

        <div class='d-flex row gap-2 w-100 m-0 mt-3 justify-content-center align-items-center'>
            
            <div id="imagem" class='d-flex imagem ml-4' {!! isset($livro->foto) ? 'style="background-image: url('. asset('assets/img/livro/' . $livro->foto).')"' : ''!!} ></div>
            
            <div class=' col'>
                {{-- <label class="form-label" for="autor">Autor*</label> --}}
                <input class="form-control border-warning" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" type="file" name="foto" placeholder="Carrega a foto do livro" autocomplete="new-password" data-input-photo='imagem'>
            </div>
        </div> 

        <button class="btn btn-primary mt-4" type="submit">Salvar</button>
    </form>
@endsection