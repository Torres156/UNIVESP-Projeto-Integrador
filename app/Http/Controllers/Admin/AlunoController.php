<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aluno;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AlunoController extends Controller
{
    public function index()
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

        return view('admin.dashboard.aluno', [
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
}
