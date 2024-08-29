<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use Illuminate\Http\Request;
use App\Models\ModelClient;

class ClientController extends Controller
{
    private $ObjClient;

    public function __construct()
    {
        $this->ObjClient = new ModelClient();
    }

    public function index()
    {
        $clients = $this->ObjClient->all();
        return view('index', compact('clients'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(ClientRequest $request)
    {
        // Verifica se a requisição contém um arquivo de imagem e realiza o upload
        if($request->hasFile('foto') && $request->file('foto')->isValid()){
            $requestImage = $request->foto;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $request->foto->move(public_path('img/clients'), $imageName);
        }       

        // Criação do cliente
        $this->ObjClient->create([
            'nome' => $request->nome,
            'data_nascimento' => $request->data_nascimento,
            'cpf_cnpj' => $request->cpf_cnpj,
            'foto' => $imageName,
            'nome_social' => $request->nome_social,
        ]);

        // Redireciona para a página de listagem com uma mensagem de sucesso
        return redirect('clients')->with('success', 'Cliente cadastrado com sucesso!');
    }

    public function show(string $id)
    {   

        $client=$this->ObjClient->find($id);
        return view('show', compact('client'));
    }

    public function edit(string $id)
    {
        $client=$this->ObjClient->find($id);
        return view('create', compact('client'));
    }   

    public function update(ClientRequest $request, string $id)
    {

        $file_name = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $file_name = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $file_name);
        }

        $this->ObjClient->where(['id'=>$id])->update([
            'nome' => $request->nome,
            'data_nascimento' => $request->data_nascimento,
            'cpf_cnpj' => $request->cpf_cnpj,
            'foto' => $file_name,
            'nome_social' => $request->nome_social,
        ]);

        return redirect('clients');
    }

    public function destroy(string $id)
    {
        $del=$this->ObjClient->destroy($id);
        return($del)?"sim":"nao";
    }
}
