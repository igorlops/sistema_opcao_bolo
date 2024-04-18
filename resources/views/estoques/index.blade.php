@extends('layouts.app')
@section('titulo_site','Estoques')
@section('title')
    <h1>Listagem de Estoque</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{url('/estoques')}}">Listagem Estoque</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card bg-dark">
                    <div class="card-header">Estoques</div>
                    <div class="card-body">
                        <a href="{{ route('estoques.create') }}" class="btn btn-success btn-sm" title="Novo Estoque">
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
                                <input type="text" class="form-control" name="data_ini" placeholder="Data Inicial" value="{{ request('data_ini') }}">
                                <input type="text" class="form-control" name="data_fin" placeholder="Data final" value="{{ request('data_fin') }}">
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
                                @foreach($produtos as $produto)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $produto->nome }}</td>
                                        <td>{{ $produto->producao ? $produto->producao : '0'}}</td>
                                        <td>{{ $produto->desperdicio ? $produto->desperdicio : '0'}}</td>
                                        <td>{{ $produto->venda ? $produto->venda : '0'}}</td>
                                        <td>{{ $produto->totalproducao - ($produto->totalvenda + $produto->totaldesperdicio) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{-- <div class="pagination-wrapper"> {!! $estoques->appends(['search' => Request::get('search')])->render() !!} </div>  --}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
