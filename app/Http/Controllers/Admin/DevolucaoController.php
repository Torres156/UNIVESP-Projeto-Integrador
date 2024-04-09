<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aluno;
use App\Models\Emprestimo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use function Termwind\render;

class DevolucaoController extends Controller
{
    function index()
    {
        $alunos = DB::select("SELECT DISTINCT a.* FROM alunos a INNER JOIN emprestimos e ON e.aluno_id = a.id WHERE e.status = 'EMPRESTADO'");

        return view('admin.dashboard.devolucao.index', [
            'title' => 'Devolução',
            'dashboard_title' => 'Devolução',
            'alunos' => $alunos,
        ]);
    }

    function pegarLivros($id)
    {
        $livros = DB::select("SELECT DISTINCT l.* FROM livros l INNER JOIN emprestimos e ON e.livro_id = l.id WHERE e.status = 'EMPRESTADO' AND e.aluno_id = $id");
        return view('admin.dashboard.devolucao.item-livros', ['livros' => $livros])->render();
    }

    function salvar(Request $request)
    {
        $request->validate(
            [
                'aluno' => 'required',
                'livro' => 'required',
                'estado' => 'required',
            ],
            [
                'required' => 'O campo :attribute não está preenchido!',
            ]
        );

        try {
            Emprestimo::where('aluno_id', $request->aluno)
                ->where('livro_id', $request->livro)
                ->update(['status' => 'DEVOLVIDO', 'estado' => $request->estado]);

            Session::flash("success", 'Devolução do livro cadastrado com sucesso!');
            return back();
        } catch (Exception $ex) {
            return back()->withInput()->withErrors("Erro ao cadastrar a devolução do livro!");
        }
    }
}
