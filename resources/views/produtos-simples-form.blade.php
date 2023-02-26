@extends('adminlte::page')

@section('title', 'Produtos Simples')

@section('content_header')
    <h1>Produtos Simples</h1>
@stop

@section('content')
<div class="row">
    <div class="col-xs-12">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{ isset($produto) ? ('Código: ' . $produto['id']) : 'Novo Produto' }}</h3>
        </div> 
        <form id="frmProdutosSimples" class="form form-produtos" type="{{ isset($produto) ? 'PUT' : 'POST' }}" action="{{ $formUrl }}" role="form">
            <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}">
            @if(isset($produto))
                <input id="codigo" type="hidden" name="id" value="{{$produto['id']}}">
            @endif
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fas fa-tag"></i>
                                </span>
                                <input id="nome" type="text" class="form-control" name="nome" placeholder="Produto" value="{{ isset($produto) ? $produto['nome'] : '' }}" required>   
                            </div>
                            <span class="nome-error help-block"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="preco_custo">Preço Custo</label>
                            <div class="input-group">
                                <span class="input-group-addon">R$</span>
                                <input id="preco_custo" type="text" class="form-control preco" name="preco_custo" placeholder="0,00" value="{{ isset($produto) ? $produto['preco_custo'] : '' }}" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="preco_venda">Preço Venda</label>
                            <div class="input-group">
                                <span class="input-group-addon">R$</span>
                                <input id="preco_venda" type="text" class="form-control preco" name="preco_venda" placeholder="0,00" value="{{ isset($produto) ? $produto['preco_venda'] : '' }}" required>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button id="btnCancelar" type="button" class="btn btn-default"
                    onclick="window.location.href = '{{ $tabelaUrl }}'">Voltar</button>
                <button id="btnSalvar" type="submit" class="btn btn-primary">Salvar</button>
                @if (isset($produto))
                    <button id="btnApagar" type="button" class="btn btn-danger">Apagar</button>
                @endif

                <span class="log">
                    @isset ($produto)
                        @php
                            if ($produto['created_at'] == $produto['updated_at']) {
                                echo 'Criado em: ' . $produto['created_at'];
                            } else {
                                echo 'Atualizado em: ' . $produto['updated_at'];
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
        var tabelaUrl = "{{ $tabelaUrl }}";
        var delUrl = "{{ $delUrl }}";
    </script>
    <script type="text/javascript" src="/js/custom.js"></script>
@stop