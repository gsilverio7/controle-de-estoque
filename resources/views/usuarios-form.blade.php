@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Usuarios</h1>
@stop

@section('content')
<div class="row">
    <div class="col-xs-12">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{ isset($usuario) ? ('Código: ' . $usuario['id']) : 'Novo Usuario' }}</h3>
        </div> 
        <form id="frmUsuarios" class="form form-produtos" type="{{  isset($usuario) ? 'PUT' : 'POST' }}" action="{{ $formUrl }}" role="form">
            <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}">
            @if(isset($usuario))
                <input id="codigo" type="hidden" name="id" value="{{$usuario['id']}}">
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
                                <input id="nome" type="text" class="form-control" name="name" placeholder="John Doe" value="{{ isset($usuario) ? $usuario['name'] : '' }}" required>   
                            </div>
                            <span class="nome-error help-block"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="preco_custo">E-mail</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                <input id="email" type="email" class="form-control" name="email" placeholder="john.doe@mail.com" value="{{ isset($usuario) ? $usuario['email'] : '' }}" required>
                            </div>
                            <span class="email-error help-block"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="preco_venda">{{ isset($usuario) ? 'Mudar' : '' }} Senha</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-lock"></i>
                                </span>
                                <input id="new_password" type="password" class="form-control" name="new_password" placeholder="{{ isset($usuario) ? 'Opcional' : 'Senha' }}" {{ isset($usuario) ? '' : 'required' }} autocomplete="new_password">
                            </div>
                            <span class="new_password-error help-block"></span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="preco_venda">Confirmar Senha</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-lock"></i>
                                </span>
                                <input id="new_password_confirm" type="password" class="form-control" name="new_password_confirm" placeholder="{{ isset($usuario) ? 'Opcional' : 'Senha' }}" {{ isset($usuario) ? '' : 'required' }} autocomplete="off">
                            </div>
                            <span class="new_password_confirm-error help-block"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button id="btnCancelar" type="button" class="btn btn-default"
                    onclick="window.location.href = '{{ $tabelaUrl }}'">Voltar</button>
                <button id="btnSalvar" type="submit" class="btn btn-primary">Salvar</button>
                @if (isset($usuario))
                    <button id="btnApagar" type="button" class="btn btn-danger">Apagar</button>
                @endif

                <span class="log">
                    @isset ($usuario)
                        @php
                            if ($usuario['created_at'] == $usuario['updated_at']) {
                                echo 'Criado em: ' . $usuario['created_at'];
                            } else {
                                echo 'Atualizado em: ' . $usuario['updated_at'];
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
    <script>
        var tabelaUrl = @json($tabelaUrl);
        var delUrl = @json($delUrl);
    </script>
    <script type="text/javascript" src="/js/custom.js"></script>
@stop