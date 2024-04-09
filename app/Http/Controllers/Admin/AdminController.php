<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Emprestimo;
use App\Models\Livro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $atrasados = (DB::select("SELECT count(*) quantia FROM emprestimos WHERE devolucao < CURDATE() AND status='EMPRESTADO' ")[0]->quantia ?? 0);
        $emprestados = (DB::select("SELECT count(*) quantia FROM emprestimos WHERE devolucao >= CURDATE() AND status='EMPRESTADO'")[0]->quantia ?? 0);
        $livros = Livro::count();
        $emprestimos = DB::select("SELECT e.livro_nome livro, e.aluno_nome aluno, a.sala, e.created_at emprestimo, e.devolucao, (e.devolucao < CURDATE()) atrasado
                        FROM emprestimos e LEFT JOIN alunos a ON a.id = e.aluno_id WHERE e.status = 'EMPRESTADO' ORDER BY devolucao");

        return view('admin.dashboard.inicio.index', [
            'title' => 'Administração',
            'dashboard_title' => 'Início',
            'atrasados' => $atrasados,
            'emprestimos' => $emprestimos,
            'emprestados' => $emprestados,
            'livros' => $livros,
           ]);
    }

    public function sair()
    {
        Auth::logout();
        return redirect("/");
    }
}
