<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        $inputs = $request->input();        
        $usuarios = User::when(isset($inputs['name']) && !empty($inputs['name']), function($query) use ($inputs){
            $query->where('name', 'like', '%'.$inputs['name'].'%');
        })
        ->when(isset($inputs['email']) && !empty($inputs['email']), function($query) use ($inputs){
            $query->where('email', 'like', '%'.$inputs['email'].'%');
        })
        ->when(isset($inputs['acesso']) && $inputs['acesso'] != '', function($query) use ($inputs){
            $query->where('acesso',$inputs['acesso']);
        })
        ->orderBy('id', 'desc')
        ->get();
       
        return view('admin.dashboard.usuario.index', [
            'title' => 'Lista de Usuário',
            'dashboard_title' => 'Lista de Usuário',     
            'inputs' => $inputs,      
            'usuarios' => $usuarios, 
        ]);
    }

    public function editar($id)
    {
        $usuario = User::find($id);
        return view('admin.dashboard.usuario.edit', [
            'title' => 'Editar Usuário',
            'dashboard_title' => 'Editar Usuário',       
            'usuario' => $usuario,     
        ]);
    }

    public function salvar($id, Request $request)
    {
        $request->validate(
            [
                'nome' => 'required',
                'email' => 'required',
                'acesso' => 'required'
            ],
            [
                'required' => 'O campo :attribute não está preenchido!',
            ]
        );

        $data = [
            'name' => $request->nome,
            'email' => $request->email,
            'acesso' => $request->acesso,
        ];

        if (isset($request->senha))
            $data['password'] =  Hash::make($request->senha);

        try {
            $usuario = User::find($id);
            $usuario->update($data);

            Session::flash("success", 'Usuário editado com sucesso!' );
            return back();
        } catch (Exception $ex) {
            return back()->withInput()->withErrors("Erro ao editar o usuário!");
        }
    }

    public function cadastro()
    {
        return view('admin.dashboard.usuario.cadastro', [
            'title' => 'Cadastro de Usuário',
            'dashboard_title' => 'Cadastro de Usuário',            
        ]);
    }

    public function novo(Request $request)
    {
        $request->validate(
            [
                'nome' => 'required',
                'email' => 'required',
                'senha' => 'required',
                'acesso' => 'required'
            ],
            [
                'required' => 'O campo :attribute não está preenchido!',
            ]
        );

        $data = [
            'name' => $request->nome,
            'email' => $request->email,
            'password' => Hash::make($request->senha),
            'acesso' => $request->acesso,
        ];

        try {
            $usuario = new User($data);
            $usuario->save();

            Session::flash("success", 'Usuário cadastrado com sucesso!' );
            return back();
        } catch (Exception $ex) {
            return back()->withInput()->withErrors("Erro ao cadastrar o usuário!");
        }
    }
}
