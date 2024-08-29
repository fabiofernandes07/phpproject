@extends('templates.template')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3>Detalhes do Cliente</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Foto do Cliente -->
                <div class="col-md-3 text-center">
                    <img src="/img/clients/{{$client->foto }}" alt="Foto de {{ $client->nome }}" class="img-fluid rounded-circle mb-3" style="max-width: 150px;">
                </div>

                <!-- Informações do Cliente -->
                <div class="col-md-9">
                    <h4>{{ $client->nome }}</h4>
                    <p><strong>Data de Nascimento:</strong> {{ $client->data_nascimento }}</p>
                    <p><strong>CNPJ/CPF:</strong> {{ $client->cpf_cnpj }}</p>
                    <p><strong>Nome Social:</strong> {{ $client->nome_social ?? 'Não informado' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
