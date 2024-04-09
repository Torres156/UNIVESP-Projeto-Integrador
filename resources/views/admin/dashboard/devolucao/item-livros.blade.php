<option hidden value="" selected>Selecione</option>
@foreach ($livros as $livro)
    <option value="{{ $livro->id }}">{!! $livro->nome . ' - ' . $livro->id !!}</option>
@endforeach
