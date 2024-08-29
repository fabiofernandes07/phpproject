@extends('templates.template');

@section('content')
<h1 class="text-center">@if(isset($client))Editar @else Cadastrar @endif</h1>

<div class="col-8 m-auto">

    @if(isset($errors) && count($errors) > 0)
    <div class="text-center mt-4 mb-4 p-2">
        @foreach($errors->all() as $erro)
        <p>{{$erro}}</p>
        @endforeach
    </div>
    @endif

    @if(isset($client))

    <form action="{{url("clients/$client->id")}}" method="post" enctype="multipart/form-data">
        @method('PUT')

        @else

        <form action="{{url('clients')}}" method="post" enctype="multipart/form-data">

            @endif

            @csrf

            <!-- Nome -->
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome completo" value="{{$client->nome ?? ''}}" required>
            </div>

            <!-- Data de Nascimento -->
            <div class="mb-3">
                <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" value="{{$client->data_nascimento ?? ''}}" required>
            </div>

            <!-- Opções de CPF ou CNPJ -->
            <div class="mb-3">
                <label class="form-label">Tipo de Documento</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tipo_documento" id="cpf" value="cpf" checked>
                    <label class="form-check-label" for="cpf">CPF</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tipo_documento" id="cnpj" value="cnpj">
                    <label class="form-check-label" for="cnpj">CNPJ</label>
                </div>
            </div>

            <!-- Campo para CPF ou CNPJ -->
            <div class="mb-3">
                <label for="cpf_cnpj" class="form-label" id="labelDocumento">CPF</label>
                <input type="text" class="form-control" id="cpf_cnpj" name="cpf_cnpj" placeholder="Digite o CPF" value="{{$client->cpf_cnpj ?? ''}}" required>
            </div>

            <!-- Foto -->
            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" class="form-control" id="foto" name="foto" accept=".png, .jpg, .jpeg">
            </div>

            <!-- Nome Social -->
            <div class="mb-3">
                <label for="nome_social" class="form-label">Nome Social</label>
                <input type="text" class="form-control" id="nome_social" name="nome_social" placeholder="Digite o nome social" value="{{$client->nome_social ?? ''}}">
            </div>

            <!-- Botão de Envio -->

            <button type="submit" class="btn btn-primary">@if(isset($client))Editar Cliente @else Cadastrar Cliente @endif</button>

        </form>

        <!-- JavaScript para alterar a label, placeholder, e validar CPF/CNPJ -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const cpfRadio = document.getElementById('cpf');
                const cnpjRadio = document.getElementById('cnpj');
                const labelDocumento = document.getElementById('labelDocumento');
                const inputDocumento = document.getElementById('cpf_cnpj');
                const form = document.getElementById('formCadastro');

                // Função para alterar a label e o placeholder
                function alterarLabel() {
                    if (cpfRadio.checked) {
                        labelDocumento.textContent = 'CPF';
                        inputDocumento.placeholder = 'Digite o CPF';
                    } else if (cnpjRadio.checked) {
                        labelDocumento.textContent = 'CNPJ';
                        inputDocumento.placeholder = 'Digite o CNPJ';
                    }
                }

                // Função para validar CPF
                function validarCPF(cpf) {
                    const regex = /^\d{3}\.\d{3}\.\d{3}\-\d{2}$/;
                    return regex.test(cpf);
                }

                // Função para validar CNPJ
                function validarCNPJ(cnpj) {
                    const regex = /^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$/;
                    return regex.test(cnpj);
                }

                // Função para validar o documento
                function validarDocumento(event) {
                    const valor = inputDocumento.value;
                    let valido = false;

                    if (cpfRadio.checked) {
                        valido = validarCPF(valor);
                        if (!valido) {
                            alert("CPF inválido. O formato correto é XXX.XXX.XXX-XX");
                            event.preventDefault();
                        }
                    } else if (cnpjRadio.checked) {
                        valido = validarCNPJ(valor);
                        if (!valido) {
                            alert("CNPJ inválido. O formato correto é XX.XXX.XXX/XXXX-XX");
                            event.preventDefault();
                        }
                    }
                }

                // Adiciona os eventos de mudança para os rádios
                cpfRadio.addEventListener('change', alterarLabel);
                cnpjRadio.addEventListener('change', alterarLabel);

                // Adiciona o evento de submissão do formulário para validação
                form.addEventListener('submit', validarDocumento);
            });
        </script>


</div>


@endsection