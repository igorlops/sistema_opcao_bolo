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
                                <input class="form-control data" type="text" name="data_inicial" value="{{request('data_inicial')}}" id="data_inicial">
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label" for="data_final">Data final</label>
                            <div class="input-group">
                                <input class="form-control data" type="text" name="data_final" value="{{request('data_final')}}" id="data_final">
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
                                @forelse ($users as $user)
                                    <option value="{{$user->id}}" @if ($user->id == request('usuario_select'))  selected @endif>{{$user->name}}</option>
                                                                       @empty

                                   <tr>
                                       <td>Não há dados cadastrados</td>
                                   </tr>
                                @endforelse
                            @else
                                <option value="" selected>Selecione um usuário</option>
                                @forelse ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                                       @empty

                                   <tr>
                                       <td>Não há dados cadastrados</td>
                                   </tr>
                                @endforelse
                            @endif
                        </select>
                    </div>
                    <div class="py-3 col-sm-3">
                        <h4>Forma de pagamento</h4>
                        <select class="form-select" name="formaPagamento" id="formaPagamento">
                            @if (request('formaPagamento'))
                                <option value="">Selecione uma forma de pagamento</option>
                                @forelse ($pagamentos as $pagamento)
                                    <option value="{{$pagamento->id}}" @if ($pagamento->id == request('formaPagamento'))  selected @endif>{{$pagamento->nome}}</option>
                                                                       @empty

                                   <tr>
                                       <td>Não há dados cadastrados</td>
                                   </tr>
                                @endforelse
                            @else
                                <option value="">Selecione uma forma de pagamento</option>
                                @forelse ($pagamentos as $pagamento)
                                    <option value="{{$pagamento->id}}">{{$pagamento->nome}}</option>
                                                                       @empty

                                   <tr>
                                       <td>Não há dados cadastrados</td>
                                   </tr>
                                @endforelse
                            @endif
                        </select>
                    </div>
                    <div class="py-3 col-sm-3">
                        <h4>Tipo de saída</h4>
                        <select class="form-select" name="tipoSaida" id="tipoSaida">
                            @if (request('tipoSaida'))
                                <option value="">Selecione um usuário</option>
                                @forelse ($tipoSaidas as $saida)
                                    <option value="{{$saida->id}}" @if ($saida->id == request('tipoSaida'))  selected @endif>{{$saida->descricao}}</option>
                                                                       @empty

                                   <tr>
                                       <td>Não há dados cadastrados</td>
                                   </tr>
                                @endforelse
                            @else
                                <option value="" selected>Selecione um usuário</option>
                                @forelse ($tipoSaidas as $saida)
                                    <option value="{{$saida->id}}">{{$saida->descricao}}</option>
                                                                       @empty

                                   <tr>
                                       <td>Não há dados cadastrados</td>
                                   </tr>
                                @endforelse
                            @endif
                        </select>
                    </div>

                    <div class="py-3 col-sm-3">
                        <h4>Produto</h4>
                        <select class="form-select" name="produto" id="produto">
                            @if (request('produto'))
                                <option value="">Selecione um produto</option>
                                @forelse ($produtos as $produto)
                                    <option value="{{$produto->id}}" @if ($produto->id == request('produto'))  selected @endif>{{$produto->nome}}</option>
                                                                       @empty

                                   <tr>
                                       <td>Não há dados cadastrados</td>
                                   </tr>
                                @endforelse
                            @else
                                <option value="" selected>Selecione um produto</option>
                                @forelse ($produtos as $produto)
                                    <option value="{{$produto->id}}">{{$produto->nome}}</option>
                                                                       @empty

                                   <tr>
                                       <td>Não há dados cadastrados</td>
                                   </tr>
                                @endforelse
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
            <button class="nav-link" id="totais-tab" data-bs-toggle="tab" data-bs-target="#totais-tab-pane" type="button" role="tab" aria-controls="totais-tab-pane" aria-selected="false">Lucros</button>
        </li>
    </ul>

    {{-- Tab Panels --}}
    <div class="tab-content" id="myTabContent">

        {{-- Cards com detalhes das saidas por usuário --}}
        <div class="tab-pane fade show active" id="user-tab-pane" role="tabpanel" aria-labelledby="user-tab" tabindex="0">
            <h2 class="text-center mt-4">Resumo</h2>
                <div class="d-flex justify-content-between flex-column">
                    <div class="col-12 d-flex justify-content-around pt-5 px-0">
                        <div class="col-6">
                            <div class="card bg-dark">
                                <div class="card-header">Tipos de pagamentos</div>
                                <div class="card-body">
                                    @forelse ($filtro_pagamentos as $tipopagamento)
                                        <p><strong>{{$tipopagamento->nome}}:</strong> R$ <span>{{$tipopagamento->soma_valores ? numero_iso_para_br($tipopagamento->soma_valores) : '0.00'}}</span></p>

                                        @empty
                                        <tr>
                                            <td>Não há dados cadastrados</td>
                                        </tr>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card bg-dark">
                                <div class="card-header">Tipos de saidas</div>
                                <div class="card-body">
                                    @forelse ($filtro_saida as $tiposaida)
                                        <p><strong>{{$tiposaida->descricao}}:</strong> R$ <span>{{$tiposaida->soma_saidas ? numero_iso_para_br($tiposaida->soma_saidas) : '0.00'}}</span></p>
                                        @empty
                                        <tr>
                                            <td>Não há dados cadastrados</td>
                                        </tr>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card bg-dark">
                            <div class="card-header">Produtos mais vendidos</div>
                            <div class="card-body">
                                <table class="table table-hover table-dark">
                                    <thead>
                                    @forelse ($filtro_vendas as $produto)
                                        <th>{{$produto->nome}}</th>
                                        @empty
                                        <tr>
                                            <td>Nenhum produto cadastrado</td>
                                        </tr>
                                    @endforelse
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @foreach ($filtro_vendas as $produto)
                                                <td>{{$produto->contador_produtos ? $produto->contador_produtos : '0'}}</td>
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="totais-tab-pane" role="tabpanel" aria-labelledby="totais-tab" tabindex="0">
            <div class="pt-5">
                <div class="card bg-dark">
                    <div class="card-body">
                        <h5 class="text-center">
                            Estimativa de lucros
                        </h5>
                        {{-- @dd($item) --}}
                        <div class="table-responsive">
                            <table class="table table-dark table-hover">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Taxa crédito</th>
                                        <th>Taxa débito</th>
                                        <th>Total Caixa</th>
                                        <th>Envelope</th>
                                        <th>Pix</th>
                                        <th>Cartão de crédito</th>
                                        <th>Cartão de débito</th>
                                        <th>Diferença</th>
                                    </tr>
                                </thead>
                               <tbody>
                               @forelse($fechamento as $item)
                               {{-- @dd($fechamento) --}}
                                    <tr>
                                        <td>{{$item["name"]}}</td>
                                        <td>{{numero_iso_para_br($item["perc_cred"])}}</td>
                                        <td>{{numero_iso_para_br($item["perc_deb"])}}</td>
                                        <td>{{numero_iso_para_br($item["total_caixa"])}}</td>
                                        <td>{{numero_iso_para_br($item["env"])}}</td>
                                        <td>{{numero_iso_para_br($item["pix"])}}</td>
                                        <td>{{numero_iso_para_br($item["cartao_cred"])}}</td>
                                        <td>{{numero_iso_para_br($item["cartao_deb"])}}</td>
                                        <td>{{numero_iso_para_br($item["diferenca"])}}</td>
                                    </tr>
                                   @empty
                                   <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Não houve fechamentos de caixa</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                               @endforelse
                               </tbody>
                           </table>
                           {{-- <div class="pagination-wrapper"> {!! $produtos->appends(['search' => Request::get('search')])->render() !!} </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
