@extends('admin.dashboard.index')

@section('content')
    <section class="livro p-4 mt-2 w-100 pt-0 ">
        <table class="table table-hover table-responsive">
            <thead class="sticky-top">
                <tr>
                    <th scope="col" class="col-1">#</th>
                    <th scope="col">Aluno</th>
                    <th scope="col" class="col-2">RA</th>
                    <th scope="col" class='col-3'>Livros Lidos</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $rank = 0;
                    $lastQuantia = 0;
                @endphp
                @foreach ($alunos as $aluno)
                    @php
                        if ($lastQuantia !== $aluno->quantia) 
                        {
                            $rank++; 
                            $lastQuantia = $aluno->quantia;
                        }
                    @endphp
                    <tr>
                        <th scope="row">
                            @php
                                $medal = '';
                                switch ($rank) {
                                    case 1:
                                        $medal =
                                            "<i class='bx bx-medal' style='text-shadow: rgb(0, 0, 0) 0 0 5px, rgb(0, 0, 0) 0 0 5px; color:rgb(255, 223, 118)'></i>";
                                        break;
                                    case 2:
                                        $medal =
                                            "<i class='bx bx-medal' style='text-shadow: rgb(0, 0, 0) 0 0 5px, rgb(0, 0, 0) 0 0 5px; color:rgb(219, 219, 219)'></i>";
                                        break;
                                    case 3:
                                        $medal =
                                            "<i class='bx bx-medal' style='text-shadow: rgb(0, 0, 0) 0 0 5px, rgb(0, 0, 0) 0 0 5px; color:rgb(201, 142, 70)'></i>";
                                        break;
                                }
                            @endphp
                            {!! $rank < 4
                                ? $rank . $medal
                                : $rank !!}</th>
                        <td>{{ $aluno->nome }}</td>
                        <td>{{ $aluno->ra }}</td>
                        <td>{{ $aluno->quantia }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </section>
@endsection
