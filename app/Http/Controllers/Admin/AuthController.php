<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function Index()
    {
        if (Auth::user())
            return redirect()->route("admin.dashboard");

        return view("admin.auth.index");
    }

    public function entrar(Request $request)
    {
        $request->validate(
            [
                'usuario' => 'required|min:3|max:40',
                'senha' => 'required|min:3|max:20'
            ],
            [
                'required' => 'O campo :attribute não está preenchido!',
                'min' => 'Mínimo :min letras no campo :attribute!',
                'max' => 'Máximo :max letras no campo :attribute!'
            ]
        );

        $email = $request->usuario;
        $senha = $request->senha;

        // Verificar se existe
        $user = User::where([
            ['email', '=', $email]
        ])->first();

        if (!isset($user))
            return back()->withErrors("Conta não encontrada!");

        $result = Hash::check($senha, $user->password);
        if (!$result)
            return back()->withErrors("Conta ou senha inválida!");

        Auth::login($user, true);
        return redirect()->route("admin.dashboard");
    }
}
