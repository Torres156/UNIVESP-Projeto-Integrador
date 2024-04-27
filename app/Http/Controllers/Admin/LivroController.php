<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Livro;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LivroController extends Controller
{
    function index(Request $request)
    {        
        $categories = DB::table('livros')
                        ->select('categoria')
                        ->distinct()
                        ->where('categoria', 'not', 'null')
                        ->get()->all();

        $categories = [...$categories,            
            'Ficção Cientifica',
            'Aventura',
            'Drama',            
        ];     

        $categories = array_unique($categories);
        sort($categories);  

        $inputs = $request->input();        
        $livros = Livro::when(isset($inputs['codigo']) && !empty($inputs['codigo']), function ($query) use ($inputs){
            $query->where('id', $inputs['codigo']);
        })
        ->when(isset($inputs['isbn']) && !empty($inputs['isbn']), function ($query) use ($inputs){
            $query->where('isbn', $inputs['isbn']);
        })
        ->when(isset($inputs['nome']) && !empty($inputs['nome']), function ($query) use ($inputs){
            $query->where('nome', 'like', '%'. $inputs['nome']. '%');
        })
        ->when(isset($inputs['categoria']) && !empty($inputs['categoria']), function ($query) use ($inputs){
            $query->where('categoria', $inputs['categoria']);
        })
        ->orderBy('id', 'desc')
        ->get();

        return view('admin.dashboard.livro.index', [
            'title' => 'Lista de Livros',
            'dashboard_title' => 'Lista de Livros',
            'categories' => $categories,
            'livros' => $livros,
            'inputs' => $inputs,
        ]); 
    }

    function cadastro()
    {
        $categories = DB::table('livros')
                        ->select('categoria')
                        ->distinct()
                        ->where('categoria', 'not', 'null')
                        ->get()->all();

        $categories = [...$categories,            
            'Ficção Cientifica',
            'Aventura',
            'Drama',            
        ];     

        $categories = array_unique($categories);
        sort($categories);   
        
        $new_id = (DB::select("SELECT MAX(id) + 1 max FROM livros")[0]->max ?? 1 );

        return view('admin.dashboard.livro.cadastro', [
            'title' => 'Cadastro de Livro',
            'dashboard_title' => 'Cadastro de Livro',
            'new_id' => $new_id,
            'categories' => $categories,
        ]);
    }

    function novo(Request $request)
    {
        $request->validate(
            [
                'nome' => 'required|max:100',
                'autor' => 'required|max:100',
                'faixa_etaria' => 'required|numeric',                
            ],
            [
                'required' => 'O campo :attribute não está preenchido!',                
                'max' => 'Máximo :max letras no campo :attribute!',
                'numeric' => 'O campo :attribute possui caractere inválido!',
            ]
        );

        $inputs = $request->all();
        // Imagem desktop
        $imagem = $request->foto;
        if ($imagem) {
            try {
                $e = $imagem->getClientOriginalExtension();
                $nomeFoto = '';
                if ($e === 'webp') {
                    $nomeFoto = round(microtime(true) * 1000) . '.' . $e;
                    $imagem->storeAs('assets/img/livro/', $nomeFoto, 'public');
                } else {
                    $nomeFoto = round(microtime(true) * 1000);
                    $imagem->storeAs('assets/img/livro/', $nomeFoto . '.' . $e, 'public');

                    $this->convertToWebp(public_path('assets/img/livro/') . $nomeFoto . "." . $e, 90, true);
                    $nomeFoto .= '.webp';
                }

                $inputs['foto'] = $nomeFoto;
            } catch (\Exception $e) {
                return back()->withErrors(['Falha ao carregar imagem!\n' . $e->getMessage()]);
            }
        } else
            $inputs['foto'] = null;

        try {
            $livro = new Livro($inputs);
            $livro->save();

            Session::flash("success", 'Livro cadastrado com sucesso!' );
            return back();
        } catch (Exception $ex) {
            return back()->withInput()->withErrors("Erro ao cadastrar o livro!");
        }
    }

    function convertToWebp($source, $quality = 100, $removeOld = false)
    {
        $dir = pathinfo($source, PATHINFO_DIRNAME);
        $name = pathinfo($source, PATHINFO_FILENAME);
        $destination = $dir . DIRECTORY_SEPARATOR . $name . '.webp';
        $info = getimagesize($source);
        $isAlpha = false;
        if ($info['mime'] == 'image/jpeg')
            $image = imagecreatefromjpeg($source);
        elseif ($isAlpha = $info['mime'] == 'image/gif') {
            $image = imagecreatefromgif($source);
        } elseif ($isAlpha = $info['mime'] == 'image/png') {
            $image = imagecreatefrompng($source);
        } else {
            return $source;
        }
        if ($isAlpha) {
            imagepalettetotruecolor($image);
            imagealphablending($image, true);
            imagesavealpha($image, true);
        }
        imagewebp($image, $destination, $quality);

        if ($removeOld)
            unlink($source);

        return $destination;
    }

    function editar($id)
    {
        $categories = DB::table('livros')
                        ->select('categoria')
                        ->distinct()
                        ->where('categoria', 'not', 'null')
                        ->get()->all();

        $categories = [...$categories,            
            'Ficção Cientifica',
            'Aventura',
            'Drama',            
        ];     

        $categories = array_unique($categories);
        sort($categories);   
        
        $livro = Livro::find($id);

        return view('admin.dashboard.livro.edit', [
            'title' => 'Editar Livro',
            'dashboard_title' => 'Editar Livro',
            'livro' => $livro,
            'categories' => $categories,
        ]);
    }

    function salvar(Request $request)
    {
        $request->validate(
            [
                'codigo' => 'required',
                'nome' => 'required|max:100',
                'autor' => 'required|max:100',
                'faixa_etaria' => 'required|numeric',                
            ],
            [
                'required' => 'O campo :attribute não está preenchido!',                
                'max' => 'Máximo :max letras no campo :attribute!',
                'numeric' => 'O campo :attribute possui caractere inválido!',
            ]
        );

        $livro = Livro::find($request->codigo);

        $inputs = $request->all();
        // Imagem desktop
        $imagem = $request->foto;
        if ($imagem) {
            try {
                $e = $imagem->getClientOriginalExtension();
                $nomeFoto = '';
                if ($e === 'webp') {
                    $nomeFoto = round(microtime(true) * 1000) . '.' . $e;
                    $imagem->storeAs('assets/img/livro/', $nomeFoto, 'public');
                } else {
                    $nomeFoto = round(microtime(true) * 1000);
                    $imagem->storeAs('assets/img/livro/', $nomeFoto . '.' . $e, 'public');

                    $this->convertToWebp(public_path('assets/img/livro/') . $nomeFoto . "." . $e, 90, true);
                    $nomeFoto .= '.webp';
                }

                $inputs['foto'] = $nomeFoto;
            } catch (\Exception $e) {
                return back()->withErrors(['Falha ao carregar imagem!\n' . $e->getMessage()]);
            }
        } else
            $inputs['foto'] = null;

        try {
            
            $livro->update($inputs);

            Session::flash("success", 'Livro atualizado com sucesso!' );
            return back();
        } catch (Exception $ex) {
            return back()->withInput()->withErrors("Erro ao atualizar o livro!");
        }
    }

}
