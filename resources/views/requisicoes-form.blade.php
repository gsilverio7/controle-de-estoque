@extends('adminlte::page')

@section('title', 'Requisições')

@section('content_header')
    <h1>Requisições</h1>
@stop

@section('content')
<div class="row">
    <div class="col-xs-12">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{ isset($requisicao) ? ('Código: ' . $requisicao['id']) : 'Nova Requisição' }}</h3>
        </div> 
        <form id="frmProdutosCompostos" class="form form-produtos" type="{{  isset($requisicao) ? 'PUT' : 'POST' }}" 
            action="{{ $formUrl }}" role="form">
            <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}">
            @if(isset($requisicao))
                <input id="codigo" type="hidden" name="id" value="{{$requisicao['id']}}">
            @else
                <input id="user" type="hidden" name="id_user" value="{{ auth()->user()->id }}">
            @endif
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Tipo</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <div class="icone">
                                        <i class="fa fa-book"></i>
                                    </div>
                                </span>
                                <select class="form-control" name="tipo" id="tipo" {{ isset($requisicao) ? 'disabled' : '' }}>
                                    <option value="v" {{ (isset($requisicao) && $requisicao['tipo'] == 'Venda') ? 'selected' : '' }}>Venda</option>
                                    <option value="c" {{ (isset($requisicao) && $requisicao['tipo'] == 'Compra') ? 'selected' : '' }}>Compra</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                @if (isset($requisicao) && ! empty($requisicao['movimentacoes']))
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Responsável</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <div class="icone">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </span>
                                    <input type="text" class="form-control" value="{{ $requisicao['usuario']['name'] }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Data</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <div class="icone">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </span>
                                    <input type="text" class="form-control date" value="{{ $requisicao['created_at'] }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach ($requisicao['movimentacoes'] as $key => $componente)
                        <input type="hidden" name="id_movimentacao[]" value={{ $componente['id'] }}>
                        <div id="{{ ($key == 0) ? 'componenteRow' : 'componenteExistenteRow'.$key }}" class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Tipo de Produto</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <div class="icone">
                                                <i class="fa fa-book"></i>
                                            </div>
                                        </span>
                                        <select class="form-control tipoProduto" name="tipo_produto[]">
                                            <option value="s" {{ is_null($componente['id_produto_composto']) ? 'selected' : '' }}>Simples</option>
                                            <option value="c" {{ is_null($componente['id_produto_simples']) ? 'selected' : '' }}>Composto</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Produto</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">                                
                                            <div class="icone">
                                                <i class="fa fa-tags"></i>
                                            </div>
                                        </span>
                                        <select class="form-control componente" name="id_produto[]" 
                                            data-cbo="{{ is_null($componente['id_produto_simples']) ? route('produtos_compostos.cbo') : route('produtos_simples.cbo') }}" required>
                                            <option value="{{ is_null($componente['id_produto_simples']) ? $componente['id_produto_composto'] : $componente['id_produto_simples'] }}">
                                                {{ is_null($componente['id_produto_simples']) ? $componente['produto_composto']['nome'] : $componente['produto_simples']['nome'] }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Quantidade</label>
                                    <input type="number" min="1" class="form-control qtd" name="quantidade[]" value="{{ $componente['quantidade'] }}" required>
                                </div>
                            </div>
                            <div id="{{ ($key == 0) ? '' : 'del'.$key }}" class="divBtnDel col-md-1 {{ ($key == 0) ? 'hidden' : 'btnDelExistente' }}">
                                <label for="">&nbsp;</label>
                                <button class="btn btn-block btn-danger del">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                @else 
                <div id="componenteRow" class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Tipo de Produto</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <div class="icone">
                                        <i class="fa fa-book"></i>
                                    </div>
                                </span>
                                <select class="form-control tipoProduto" name="tipo_produto[]">
                                    <option value="s">Simples</option>
                                    <option value="c">Composto</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Produto</label>
                            <div class="input-group">
                                <span class="input-group-addon">                                
                                    <div class="icone">
                                        <div class="icone">
                                            <i class="fa fa-tags"></i>
                                        </div>
                                    </div>
                                </span>
                                <select class="form-control componente" name="id_produto[]" 
                                    data-cbo="{{ route('produtos_simples.cbo') }}" required>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Quantidade</label>
                            <input type="number" min="1" class="form-control qtd" name="quantidade[]" required>
                        </div>
                    </div>
                    <div class="divBtnDel col-md-1 hidden">
                        <label for="">&nbsp;</label>
                        <button class="btn btn-block btn-danger">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </div>
                @endif
                <div id="addComponente" class="text-right">
                    <a id="btnAddComponente" href="#">
                        + adicionar produto
                    </a>
                </div>
            </div>
            <div class="box-footer">
                <button id="btnCancelar" type="button" class="btn btn-default"
                    onclick="window.location.href = '{{ $tabelaUrl }}'">Voltar</button>
                <button id="btnSalvar" type="submit" class="btn btn-primary">Salvar</button>
                @if (isset($requisicao))
                    <button id="btnApagar" type="button" class="btn btn-danger">Apagar</button>
                @endif

                <span class="log">
                    @isset ($requisicao)
                        @php
                            if ($requisicao['created_at'] == $requisicao['updated_at']) {
                                echo 'Criado em: ' . $requisicao['created_at'];
                            } else {
                                echo 'Atualizado em: ' . $requisicao['updated_at'];
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
        $('.date').mask('00/00/0000 00:00:00', {placeholder: "__/__/____ __:__:__"});

        var tabelaUrl = "{{ $tabelaUrl }}";
        var delUrl = "{{ $delUrl }}";

        function cbo(select) {
            select.select2({
                ajax: {
                    url: select.attr('data-cbo'),
                    dataType: 'json'
                }
            });
        }
        cbo($('.componente'));

        var i = 0;
        $('#btnAddComponente').on('click', function() {
            i++;
            var divId = "componenteRow" + i;
            $('#componenteRow .componente').select2("destroy")
            $('#componenteRow').clone().attr('id', divId).insertBefore('#addComponente');
            $('#' + divId + ' .componente').val(null).trigger('change');
            $('#' + divId + ' .qtd').val(null);
            cbo($('.componente'));

            $('#' + divId + ' .divBtnDel').removeClass('hidden');
            $('#' + divId + ' .divBtnDel .btn').on('click', function() {
                $('#' + divId).remove();
            })

            $('#' + divId + ' .tipoProduto').on('change', function(e) {
                var tipo = $(this).val();
                var row = divId;
                console.log(row);
                var select = $('#' + row + ' .componente');
                select.val(null).trigger('change').empty();
                select.select2('destroy');
                if (tipo == 's') {
                    select.attr('data-cbo', "{{ route('produtos_simples.cbo') }}")
                    cbo(select);
                } else {
                    select.attr('data-cbo', "{{ route('produtos_compostos.cbo') }}")
                    cbo(select);
                }
            });
        });

        $('.btnDelExistente').on('click', function(e) {
            e.preventDefault();
            var rowId = 'componenteExistenteRow' + this.id.slice(3);
            $('#' + rowId).remove();
        });

        $('.tipoProduto').on('change', function(e) {
            var tipo = $(this).val();
            var row = $(this).parent().parent().parent().parent().attr('id');
            console.log(row);
            var select = $('#' + row + ' .componente');
            select.val(null).trigger('change');
            select.select2('destroy');
            if (tipo == 's') {
                select.attr('data-cbo', "{{ route('produtos_simples.cbo') }}")
                cbo(select);
            } else {
                select.attr('data-cbo', "{{ route('produtos_compostos.cbo') }}")
                cbo(select);
            }
        });

    </script>
    <script type="text/javascript" src="/js/custom.js"></script>
@stop