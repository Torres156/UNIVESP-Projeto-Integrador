<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aluno;
use App\Models\Emprestimo;
use App\Models\Livro;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class EmprestimoController extends Controller
{
    function index()
    {
        $alunos = Aluno::orderBy('nome')->get()->all();
        $livros = DB::select("SELECT * FROM livros l WHERE NOT EXISTS(SELECT * FROM emprestimos e WHERE e.livro_id = l.id AND e.status = 'EMPRESTADO')");
        
        return view('admin.dashboard.emprestimo.index', [
            'title' => 'Empréstimo',
            'dashboard_title' => 'Empréstimo',
            'alunos' => $alunos, 
            'livros' => $livros,           
        ]);
    }

    function salvar(Request $request)
    {
        $request->validate(
            [
                'aluno' => 'required',
                'livro' => 'required',
                'estado' => 'required', 
                'devolucao' => 'required',
            ],
            [
                'required' => 'O campo :attribute não está preenchido!',                
            ]
        );

        $aluno = Aluno::find($request->aluno);
        $livro = Livro::find($request->livro);
        
        try {
            $emprestimo = new Emprestimo([
                'aluno_id'      => $request->aluno,
                'aluno_nome'    => $aluno->nome,
                'livro_id'      => $request->livro,
                'livro_nome'    => $livro->nome,
                'estado'        => $request->estado,
                'devolucao'     => $request->devolucao,
            ]);
            $emprestimo->save();

            Session::flash("success", 'Empréstimo cadastrado com sucesso!' );
            return back();
        } catch (Exception $ex) {
            return back()->withInput()->withErrors("Erro ao cadastrar o empréstimo!");
        }
    }
}
