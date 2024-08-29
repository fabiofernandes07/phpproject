@extends('templates.template')

@section('content')
<h1 class="col-8 m-auto">Clientes</h1>

<div class="text-center mt-3 mb-4">
    <a href="{{ url('clients/create') }}">
        <button class="btn btn-success" style="margin-left: 60%;">Cadastrar</button>
    </a>
</div>

<div class="col-8 m-auto">
    @csrf
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nome</th>
                <th scope="col">Data de Nascimento</th>
                <th scope="col">CNPJ/CPF</th>
                <th scope="col">Nome Social</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $client)
            <tr>
                <td>{{ $client->id }}</td>
                <td>{{ $client->nome }}</td>
                <td>{{ $client->data_nascimento }}</td>
                <td>{{ $client->cpf_cnpj }}</td>
                <td>{{ $client->nome_social }}</td>
                <td>
                    <a href="{{ url("clients/$client->id")}}" class="btn btn-sm btn-primary">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ url("clients/$client->id/edit")}}" class="btn btn-sm btn-info">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <a href="{{ url("clients/$client->id")}}" class="btn btn-sm btn-danger js-del">
                        <i class="fas fa-trash-alt"></i>
                    </a>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection