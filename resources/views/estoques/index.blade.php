@extends('layouts.app')
@section('titulo_site','Produção')
@section('title')
    <h1>Listagem de produção</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{url('/estoques')}}">Listagem produção</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card bg-dark">
                    <div class="card-header"><h3>Relatório de produção atual</h3></div>
                    <div class="card-body">
                        <a href="{{ route('estoques.create') }}" class="btn btn-success btn-sm" title="Nova produção">
                            <i class="bi bi-plus-lg"></i> Novo
                        </a>

                        <form method="GET"
                            action="{{ url('/estoques') }}"
                            accept-charset="UTF-8"
                            class="form-inline my-2 my-lg-0 float-right">

                            <div class="input-group">
                                @if (auth()->user()->type_user == 1)
                                    <select class="form-select" name="user_selected">
                                            <option value="" @unless (request()->has('user_selected')) selected @endunless>
                                                Selecione o usuário
                                            </option>
                                            @foreach ($users as $user)
                                                <option value="{{$user->id}}"
                                                    @if ($user->id == request('user_selected')) selected @endif>
                                                    {{$user->name}}
                                                </option>
                                            @endforeach
                                    </select>
                                @endif
                                <input type="text" class="form-control data" name="data_ini" placeholder="Data Inicial" value="{{ request('data_ini') }}">
                                <input type="text" class="form-control data" name="data_fin" placeholder="Data final" value="{{ request('data_fin') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                             <table class="table table-dark table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Produto</th>
                                        <th>Produção</th>
                                        <th>Desperdício</th>
                                        <th>Vendas</th>
                                        <th>Sobra</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($produtos as $produto)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $produto->nome }}</td>
                                        <td>{{ $produto->producao ? numero_iso_para_br($produto->producao) : '0,00'}}</td>
                                        <td>{{ $produto->desperdicio ? numero_iso_para_br($produto->desperdicio) : '0,00'}}</td>
                                        {{-- @dd( ) --}}
                                        <td>{{ $produto->vendaMetade || $produto->vendaCompleta ?
                                                numero_iso_para_br(
                                                    ($produto->vendaMetade ? ($produto->vendaMetade / 2) : 0) + ($produto->vendaCompleta ? $produto->vendaCompleta : 0)
                                                )
                                                :
                                            '0,00'}}
                                        </td>
                                        <td>{{ numero_iso_para_br(
                                            $produto->totalproducao - (
                                                (
                                                    (
                                                        ($produto->totalvendacompleta ? $produto->totalvendacompleta : 0)
                                                    ) + (
                                                        $produto->totalvendametade ? ($produto->totalvendametade / 2) : 0
                                                    )
                                                )
                                                    + $produto->totaldesperdicio
                                                    )
                                                )
                                            }}
                                        </td>
                                    </tr>
                                    @empty

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Não há dados cadastrados</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card bg-dark">
                    <div class="card-header">
                        <h3>Histórico de produção</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-dark table-hover">
                               <thead>
                                   <tr>
                                       <th>#</th>
                                       <th>Usuário</th>
                                       <th>Produto</th>
                                       <th>Tipo</th>
                                       <th>Quantidade</th>
                                       <th>Data</th>
                                   </tr>
                               </thead>
                               <tbody>
                               @forelse($estoques as $estoque)
                                   <tr>
                                       <td>{{ $loop->iteration }}</td>
                                       <td>{{ $estoque->user->name }}</td>
                                       <td>{{ $estoque->produto->nome}}</td>
                                       <td>{{ $estoque->tipo_estoque === "p" ? "Produção" : "Desperdício"}}</td>
                                       <td>{{ numero_iso_para_br($estoque->quantidade) }}</td>
                                       <td>{{ data_iso_para_br($estoque->created_at) }}</td>
                                   </tr>
                                   @empty

                                   <tr>
                                       <td></td>
                                       <td></td>
                                       <td>Não há dados cadastrados</td>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                   </tr>
                               @endforelse
                               </tbody>
                            </table>
                            <div class="pagination-wrapper">
                                {!! $estoques->appends([
                                    'user_selected' => Request::get('user_selected'),
                                    'data_ini' => Request::get('data_ini'),
                                    'data_fin' => Request::get('data_fin')
                                    ])->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
