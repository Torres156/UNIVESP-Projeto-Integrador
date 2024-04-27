<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aluno;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AlunoController extends Controller
{
    public function index(Request $request)
    {
        $inputs = $request->input();

        $alunos = Aluno::when(isset($inputs['nome']) && $inputs['nome'] !== "", function($query) use($inputs){
                    $query->where('nome', 'like', '%'. $inputs['nome'] . '%');
                })
            ->when(isset($inputs['ra']) && $inputs['ra'] !== "", function($query) use($inputs){
                    $query->where('ra', 'like', $inputs['ra'] . '%');
                })
            ->orderBy("nome")->get();

        
        return view('admin.dashboard.aluno.index', [
            'title' => 'Lista de alunos',
            'dashboard_title' => 'Lista de alunos',     
            'inputs' => $inputs,
            'alunos' => $alunos,
        ]);
    }

    public function cadastro()
    {
        $salas = [];
        for ($i = 0; $i < 9; $i++) {
            $number = intval($i) / 3;
            $letra = match (intval($i) % 3) {
                0 => "A",
                1 => "B",
                2 => "C",
            };
            $salas[$i] = (intval($number) + 1) . 'ª Ano - ' . $letra;
        }

        return view('admin.dashboard.aluno.cadastro', [
            'title' => 'Cadastro de aluno',
            'dashboard_title' => 'Cadastro de aluno',
            'salas' => $salas,
        ]);
    }

    public function gravar(Request $request)
    {
        $request->validate(
            [
                'nome' => 'required|min:3|max:40',
                'ra' => 'required|numeric',
                'email' => 'max:40',
                'nascimento' => 'required',
                'telefone' => 'max:15',
                'sala' => 'required',
            ],
            [
                'required' => 'O campo :attribute não está preenchido!',
                'min' => 'Mínimo :min letras no campo :attribute!',
                'max' => 'Máximo :max letras no campo :attribute!',
                'numeric' => 'O campo :attribute possui caractere inválido!',
            ]
        );

        try {
            $aluno = new Aluno($request->all());
            $aluno->save();

            Session::flash("success", 'Aluno cadastrado com sucesso!' );
            return back();
        } catch (Exception $ex) {
            return back()->withInput()->withErrors("Erro ao cadastrar o aluno!");
        }
    }

    public function ranking()
    {
        $alunos = DB::select("SELECT DISTINCT a.nome,a.ra, (SELECT COUNT(*) FROM emprestimos WHERE aluno_id = a.id AND status = 'DEVOLVIDO') quantia FROM alunos a
        INNER JOIN emprestimos e ON e.aluno_id = a.id WHERE e.status = 'DEVOLVIDO' ORDER BY quantia DESC");

        return view('admin.dashboard.aluno.ranking', [
            'title' => 'Alunos que mais leram',
            'dashboard_title' => 'Alunos que mais leram',     
             'alunos' => $alunos,
        ]);
    }

    public function editar($id)
    {
        $salas = [];
        for ($i = 0; $i < 9; $i++) {
            $number = intval($i) / 3;
            $letra = match (intval($i) % 3) {
                0 => "A",
                1 => "B",
                2 => "C",
            };
            $salas[$i] = (intval($number) + 1) . 'ª Ano - ' . $letra;
        }

        $aluno = Aluno::find($id);

        $nascimento = new DateTime($aluno->nascimento);
        $dateDiff = $nascimento->diff(now());

        return view('admin.dashboard.aluno.edit', [
            'title' => 'Editar aluno',
            'dashboard_title' => 'Editar aluno',
            'salas' => $salas,
            'aluno' => $aluno,
            'idade' => $dateDiff->y,
        ]);
    }

    public function atualizar(Request $request)
    {
        $request->validate(
            [
                'nome' => 'required|min:3|max:40',
                'ra' => 'required|numeric',
                'email' => 'max:40',
                'nascimento' => 'required',
                'telefone' => 'max:15',
                'sala' => 'required',
                'id' => 'required',
            ],
            [
                'required' => 'O campo :attribute não está preenchido!',
                'min' => 'Mínimo :min letras no campo :attribute!',
                'max' => 'Máximo :max letras no campo :attribute!',
                'numeric' => 'O campo :attribute possui caractere inválido!',
            ]
        );

        try {
            $aluno = Aluno::find($request->id);
            $aluno->update($request->all());

            Session::flash("success", 'Aluno editado com sucesso!' );
            return back();
        } catch (Exception $ex) {
            return back()->withInput()->withErrors("Erro ao editar o aluno!");
        }

    }
}
