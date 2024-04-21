@extends('layouts.app')
@section('titulo_site','Relatório financeiro')
@section('title')
    <h1>Resumo financeiro</h1>
@endsection

@section('content')

    <div class="card bg-dark">
        <div class="p-3">
            <h4>Filtrar por data</h4>
            <form action="" method="GET">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="data_inicial" class="control-label">Data inicial</label>
                            <div class="input-group">
                                <input class="form-control date" type="text" name="data_inicial" value="{{request('data_inicial')}}" id="data_inicial">
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label" for="data_final">Data final</label>
                            <div class="input-group">
                                <input class="form-control date" type="text" name="data_final" value="{{request('data_final')}}" id="data_final">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="py-3 col-sm-3">
                        <h4>Usuário</h4>
                        <select class="form-select" name="usuario_select" id="usuario_select">
                            @if (request('usuario_select'))
                                <option value="">Selecione um usuário</option>
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}" @if ($user->id == request('usuario_select'))  selected @endif>{{$user->name}}</option>
                                @endforeach
                            @else
                                <option value="" selected>Selecione um usuário</option>
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="py-3 col-sm-3">
                        <h4>Forma de pagamento</h4>
                        <select class="form-select" name="formaPagamento" id="formaPagamento">
                            @if (request('formaPagamento'))
                                <option value="">Selecione uma forma de pagamento</option>
                                @foreach ($pagamentos as $pagamento)
                                    <option value="{{$pagamento->id}}" @if ($pagamento->id == request('formaPagamento'))  selected @endif>{{$pagamento->nome}}</option>
                                @endforeach
                            @else
                                <option value="">Selecione uma forma de pagamento</option>
                                @foreach ($pagamentos as $pagamento)
                                    <option value="{{$pagamento->id}}">{{$pagamento->nome}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="py-3 col-sm-3">
                        <h4>Tipo de saída</h4>
                        <select class="form-select" name="tipoSaida" id="tipoSaida">
                            @if (request('tipoSaida'))
                                <option value="">Selecione um usuário</option>
                                @foreach ($tipoSaidas as $saida)
                                    <option value="{{$saida->id}}" @if ($saida->id == request('tipoSaida'))  selected @endif>{{$saida->descricao}}</option>
                                @endforeach
                            @else
                                <option value="" selected>Selecione um usuário</option>
                                @foreach ($tipoSaidas as $saida)
                                    <option value="{{$saida->id}}">{{$saida->descricao}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="py-3 col-sm-3">
                        <h4>Produto</h4>
                        <select class="form-select" name="produto" id="produto">
                            @if (request('produto'))
                                <option value="">Selecione um produto</option>
                                @foreach ($produtos as $produto)
                                    <option value="{{$produto->id}}" @if ($produto->id == request('produto'))  selected @endif>{{$produto->nome}}</option>
                                @endforeach
                            @else
                                <option value="" selected>Selecione um produto</option>
                                @foreach ($produtos as $produto)
                                    <option value="{{$produto->id}}">{{$produto->nome}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="control-label"></label>
                    <div class="input-group">
                        <button class="btn btn-primary m-t-xs" title="Buscar data">Aplicar filtro</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="user-tab" data-bs-toggle="tab" data-bs-target="#user-tab-pane" type="button" role="tab" aria-controls="user-tab-pane" aria-selected="true">Resumo</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="in-out-tab" data-bs-toggle="tab" data-bs-target="#in-out-tab-pane" type="button" role="tab" aria-controls="in-out-tab-pane" aria-selected="false">Totais</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="totais-tab" data-bs-toggle="tab" data-bs-target="#totais-tab-pane" type="button" role="tab" aria-controls="totais-tab-pane" aria-selected="false">Lucros</button>
        </li>
    </ul>

    {{-- Tab Panels --}}
    <div class="tab-content" id="myTabContent">

        {{-- Cards com detalhes das saidas por usuário --}}
        <div class="tab-pane fade show active" id="user-tab-pane" role="tabpanel" aria-labelledby="user-tab" tabindex="0">
            <h2 class="text-center mt-4">Resumo</h2>
            <div class="col-12 d-flex justify-content-around pt-5">
                <div class="card bg-dark">
                    <div class="card-header">Tipos de pagamentos</div>
                    @foreach ($filtro_pagamentos as $tipopagamento)
                        <div class="card-body">
                            <p><strong>{{$tipopagamento->nome}}:</strong> R$ <span>{{$tipopagamento->soma_valores ? $tipopagamento->soma_valores : '0.00'}}</span></p>
                        </div>
                    @endforeach
                </div>

                <div class="card bg-dark">
                    <div class="card-header">Tipos de saidas</div>
                    @foreach ($filtro_saida as $tiposaida)
                        <div class="card-body">
                            <p><strong>{{$tiposaida->descricao}}:</strong> R$ <span>{{$tiposaida->soma_saidas ? $tiposaida->soma_saidas : '0.00'}}</span></p>
                        </div>
                    @endforeach
                </div>

                <div class="card bg-dark">
                    <div class="card-header">Produtos mais vendidos</div>
                    @foreach ($filtro_vendas as $produto)
                        <div class="card-body">
                            <p><strong>{{$produto->nome}}:</strong> R$ <span>{{$produto->contador_produtos ? $produto->contador_produtos : '0.00'}}</span></p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Entradas e saidas --}}
        <div class="tab-pane fade" id="in-out-tab-pane" role="tabpanel" aria-labelledby="in-out-tab" tabindex="0">
            <h2 class="pt-5">Entradas</h2>
            <div class="table-responsive">
                 <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tipo</th>
                            <th>Usuário</th>
                            <th>Descricao</th>
                            <th>Valor</th>
                            <th>Data/Hora</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach($entradas as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><span class="badge badge-success">Saídas</span></td>
                                <td>{{ $item->user->name}} </td>
                                <td>{{ $item->observacao }}</td>
                                <td>{{ numero_iso_para_br($item->valor) }}</td>
                                <td>{{ data_iso_para_br($item->created_at) }}</td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
                {{-- <div class="pagination-wrapper"> {!! $entrada->appends(['search' => Request::get('search')])->render() !!} </div> --}}
            </div>

            <h2 class="pt-5">Saídas</h2>
            <div class="table-responsive">
                 <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tipo</th>
                            <th>Usuário</th>
                            <th>Descricao</th>
                            <th>Valor</th>
                            <th>Data/Hora</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach($saidas as $saida)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><span class="badge badge-danger">Saída</span></td>
                                <td>{{ $saida->user->name }} </td>
                                <td>{{ $saida->observacao }}</td>
                                <td>{{ numero_iso_para_br($saida->valor) }}</td>
                                <td>{{ data_iso_para_br($saida->created_at) }}</td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
                {{-- <div class="pagination-wrapper"> {!! $entrada->appends(['search' => Request::get('search')])->render() !!} </div> --}}
            </div>
        </div>
        <div class="tab-pane fade" id="totais-tab-pane" role="tabpanel" aria-labelledby="totais-tab" tabindex="0">
            <div class="pt-5">
                {{-- <div class="card bg-dark">
                    <div class="card-body">
                        <h5>
                            Totais acumulados
                        </h5>
                        <h5>Total de entrada: R$ {{$total_entradas}}</h5>
                        <h5>Total saída: R$: {{$total_saidas}}</h5>
                        <h5>Diferença entre total e saída: R$ {{$diferenca}}</h5>
                    </div>

                    <div class="p-3">
                        <h4>Relatórios gráficos</h4>
                        {{-- <canvas id="graficoEntradas"></canvas>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>


@endsection
