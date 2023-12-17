@extends('adminlte::page')

@section('title', 'Produtos Compostos')

@section('content_header')
    <h1>Produtos Compostos</h1>
@stop

@section('content')
<div class="row">
    <div class="col-xs-12">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{ isset($produto) ? ('Código: ' . $produto['id']) : 'Novo Produto' }}</h3>
        </div> 
        <form id="frmProdutosCompostos" class="form form-produtos" type="{{  isset($produto) ? 'PUT' : 'POST' }}" 
            action="{{ $formUrl }}" role="form">
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
                                    <div class="icone">
                                        <i class="fas fa-tag"></i>
                                    </div>
                                </span>
                                <input id="nome" type="text" class="form-control" name="nome" placeholder="Produto" 
                                    value="{{ isset($produto) ? $produto['nome'] : '' }}" required>
                            </div>
                            <span class="nome-error help-block"></span> 
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="preco_venda">Preço Venda</label>
                            <div class="input-group">
                                <span class="input-group-addon">                                
                                    <div class="icone">R$</div>
                                </span>
                                <input id="preco_venda" type="text" class="form-control preco" name="preco_venda" placeholder="0,00" 
                                    value="{{ isset($produto) ? $produto['preco_venda'] : '' }}" required>
                            </div>
                        </div>
                    </div>
                </div>
                @if (isset($produto) && ! empty($produto['componentes']))
                    @foreach ($produto['componentes'] as $key => $componente)
                        <input type="hidden" name="id_componente[]" value={{ $componente['id'] }}>
                        <div id="{{ ($key == 0) ? 'componenteRow' : 'componenteExistenteRow'.$key }}" class="row">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label for="">Componente</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">                                
                                            <div class="icone">
                                                <i class="fa fa-tags"></i>
                                            </div>
                                        </span>
                                        <select class="form-control componente" 
                                            name="id_produto_simples[]" required>
                                            <option value="{{ $componente['produto_simples']['id'] }}" selected>{{ $componente['produto_simples']['nome'] }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="">Quantidade</label>
                                    <input type="number" min="1" class="form-control qtd" name="quantidade[]" value="{{ $componente['quantidade'] }}" required>
                                </div>
                            </div>
                            <div id="{{ ($key == 0) ? '' : 'del'.$key }}" class="divBtnDel col-sm-1 {{ ($key == 0) ? 'hidden' : 'btnDelExistente' }}">
                                <label for="">&nbsp;</label>
                                <button class="btn btn-block btn-danger del">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                @else 
                <div id="componenteRow" class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="">Componente</label>
                            <div class="input-group">
                                <span class="input-group-addon">                                
                                    <div class="icone">
                                        <i class="fa fa-tags"></i>
                                    </div>
                                </span>
                                <select class="form-control componente" 
                                    name="id_produto_simples[]" required>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="">Quantidade</label>
                            <input type="number" min="1" class="form-control qtd" name="quantidade[]" required>
                        </div>
                    </div>
                    <div class="divBtnDel col-sm-1 hidden">
                        <label for="">&nbsp;</label>
                        <button class="btn btn-block btn-danger">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </div>
                @endif
                <div id="addComponente" class="text-right">
                    <a id="btnAddComponente" href="#">
                        + adicionar componente
                    </a>
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
        var tabelaUrl = @json($tabelaUrl);
        var delUrl = @json($delUrl);
    </script>
    <script src="{{ asset('js/produtos-compostos-form.js') }}"></script>
    <script type="text/javascript" src="/js/custom.js"></script>
@stop