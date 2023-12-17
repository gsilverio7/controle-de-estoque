@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <h1>Clientes</h1>
@stop

@section('php')
    @php
        $endereco = '';
        if (isset($cliente)) {
            $endereco = $cliente['endereco'];
        }
        
        $googleMapsUrl = "https://maps.googleapis.com/maps/api/js?key=" . $googleApiKey . "&callback=loadAddress";
    @endphp
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{ isset($cliente) ? ('Código: ' . $cliente['id']) : 'Novo Cliente' }}</h3>
        </div> 
        <form id="frmClientes" class="form form-produtos" type="{{  isset($cliente) ? 'PUT' : 'POST' }}" action="{{ $formUrl }}" role="form">
            <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}">
            @if(isset($cliente))
                <input id="codigo" type="hidden" name="id" value="{{$cliente['id']}}">
            @endif
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </span>
                                <input id="nome" type="text" class="form-control" name="nome" placeholder="Nome" value="{{ isset($cliente) ? $cliente['nome'] : '' }}" required>   
                            </div>
                            <span class="nome-error help-block"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="tipo">Tipo</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <div class="icone">
                                        <i class="fa fa-book"></i>
                                    </div>
                                </span>
                                <select id="tipo" class="form-control tipoPessoa" name="tipo">
                                    <option value="f" {{ isset($cliente) && $cliente['tipo'] == 'f' ? 'selected' : '' }}>Física</option>
                                    <option value="j" {{ isset($cliente) && $cliente['tipo'] == 'j' ? 'selected' : '' }}>Jurídica</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8 {{ isset($cliente) && $cliente['tipo'] == 'j' ? 'hide' : '' }}">
                        <div class="form-group">
                            <label for="cpf">CPF</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-address-card"></i>
                                </span>
                                <input id="cpf" type="text" class="form-control cpf" name="cpf" placeholder="CPF" value="{{ isset($cliente) && $cliente['tipo'] == 'f' ? $cliente['cpf'] : '' }}" 
                                    {{ isset($cliente) && $cliente['tipo'] == 'f' ? 'required' : '' }}>   
                            </div>
                            <span class="nome-error help-block"></span>
                        </div>
                    </div>
                    <div class="col-sm-8 {{ isset($cliente) && $cliente['tipo'] == 'f' ? 'hide' : '' }}">
                        <div class="form-group">
                            <label for="cnpj">CNPJ</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-address-card"></i>
                                </span>
                                <input id="cnpj" type="text" class="form-control cnpj" name="cnpj" placeholder="CNPJ" value="{{ isset($cliente) && $cliente['tipo'] == 'j' ? $cliente['cnpj'] : '' }}"
                                    {{ isset($cliente) && $cliente['tipo'] == 'j' ? 'required' : '' }}>      
                            </div>
                            <span class="nome-error help-block"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input id="email" type="text" class="form-control" name="email" placeholder="Email" value="{{ isset($cliente) ? $cliente['email'] : '' }}" required>   
                            </div>
                            <span class="nome-error help-block"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="telefone">Telefone</label>
                            <div class="input-group">
                                <span class="input-group-addon">                                    
                                    <i class="fa fa-phone"></i>
                                </span>
                                <input id="telefone" type="text" class="form-control phone" name="telefone" placeholder="Telefone" value="{{ isset($cliente) ? $cliente['telefone'] : '' }}" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="divida">Dívida</label>
                            <div class="input-group">
                                <span class="input-group-addon">R$</span>
                                <input id="divida" type="text" class="form-control preco" name="divida" placeholder="0,00" value="{{ isset($cliente) ? $cliente['divida'] : '0,00' }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="endereco">Endereço</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-map"></i>
                                </span>
                                <input id="endereco" type="text" class="form-control" name="endereco" placeholder="Endereço" value="{{ isset($cliente) ? $cliente['endereco'] : '' }}" required>   
                            </div>
                            <span class="nome-error help-block"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button id="btnCancelar" type="button" class="btn btn-default"
                    onclick="window.location.href = '{{ $tabelaUrl }}'">Voltar</button>
                <button id="btnSalvar" type="submit" class="btn btn-primary">Salvar</button>
                @if (isset($cliente))
                    <button id="btnApagar" type="button" class="btn btn-danger">Apagar</button>
                @endif

                <span class="log">
                    @isset ($cliente)
                        @php
                            if ($cliente['created_at'] == $cliente['updated_at']) {
                                echo 'Criado em: ' . $cliente['created_at'];
                            } else {
                                echo 'Atualizado em: ' . $cliente['updated_at'];
                            }
                        @endphp
                    @endisset
                </span>
            </div>
        </form>
    </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/custom.css">
@stop

@section('js')
    <script src="{{ $googleMapsUrl }}" defer></script>
    <script>
        var tabelaUrl = @json($tabelaUrl);
        var delUrl = @json($delUrl);
        var endereco = @json($endereco);
        var apiKey = @json($googleApiKey);
    </script>
    <script src="{{ asset('js/clientes-form.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
@stop