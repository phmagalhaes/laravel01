<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    public function loginCreate()
    {
        return view('login');
    }

    public function registerCreate() 
    {
        return view('register');  
    }

    public function register(Request $request)
    {
        // validacao da requisição
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'email' => 'required|unique:usuarios,email|email',
            'senha' => 'required',
            'tipo' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect('/register')->with('errorMsg', 'Preencha todos os campos corretamente');
        }

        // criação do Usuario
        $user = new Usuario();
        $user->nome = $request->nome;
        $user->email = $request->email;
        $user->senha = Hash::make($request->senha);
        $user->tipo = $request->tipo;
        $user->save();

        // redirecionamento de sucesso
        return redirect('/')->with('successMsg', 'Usuário cadastrado com sucesso, faça seu login');
    }

    public function login(Request $request)
    {
        // validacao da requisição
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'senha' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('/')->with('errorMsg', 'Preencha todos os campos');
        }

        // verificacao da existencia do Usuario
        $user = Usuario::where('email', $request->email)->first();
        if(!$user){
            return redirect('/')->with('errorMsg', 'email ou senhas incorretos');
        }

        if(Hash::check($request->senha, $user->senha)){
            Auth::login($user);
            if($user->tipo == "adm"){
                return redirect('/home')->with('successMsg', 'Bem vindo, veja os seus sorteios');
            }
            return redirect('/sorteios/last')->with('successMsg', 'Usuário cadastrado com sucesso');
        }

        return redirect('/')->with('errorMsg', 'email ou senhas incorretos');
    }

    public function logout()
    {
        $user = auth()->user();
        Auth::logout($user);

        return redirect('/')->with('successMsg', 'Deslogado com sucesso');
    }
}
