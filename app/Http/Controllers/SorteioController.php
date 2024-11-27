<?php

namespace App\Http\Controllers;

use App\Models\Sorteio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SorteioController extends Controller
{
    public function index()
    {
        if (auth()->user()->tipo == "user") {
            return redirect('/sorteios/last')->with('errorMsg', 'Você não tem permissão para acessar!');
        }

        $sorteios = Sorteio::where('usuario_id', auth()->user()->id)->get();

        return view("home", ["sorteios" => $sorteios]);
    }

    public function lastSorteio()
    {
        $sorteios = DB::table('sorteios')->orderBy('created_at', 'DESC')->get();
        return view("lastSorteio", ["sorteio" => $sorteios[0]]);
    }

    public function create()
    {
        if (auth()->user()->tipo == "user") {
            return redirect('/sorteios/last')->with('errorMsg', 'Você não tem permissão para acessar!');
        }

        return view('createSorteio');
    }

    public function store(Request $request){
        // validacao da requisição
        $validator = Validator::make($request->all(), [
            'titulo' => 'required',
            'opcoes' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect('/sorteios/create')->with('errorMsg', 'Preencha todos os campos corretamente');
        }
        
        // criacao do Sorteio
        $today = strtotime('now');
        $sorteio = new Sorteio();
        $sorteio->titulo = $request->titulo;
        $sorteio->usuario_id = auth()->user()->id;
        $sorteio->data_criacao = date('Y-m-d', $today);
        $sorteio->data_sorteio = date('Y-m-d', $today);
        $sorteio->opcoes = explode(",", $request->opcoes);

        $randIndex = array_rand($sorteio->opcoes);
        $sorteio->sorteado = $sorteio->opcoes[$randIndex];

        if(sizeof($sorteio->opcoes) < 2 || sizeof($sorteio->opcoes) > 10){
            return redirect('/sorteios/create')->with('errorMsg', 'Mínimo de 2 opções e máximo de 10');
        }
        
        $sorteio->save();

        return redirect('/home')->with('successMsg', "sorteio criado com sucesso");
    }
}
