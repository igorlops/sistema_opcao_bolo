@extends('layouts.app')
@section('titulo_site','Entradas')
@section('title')
    <h1>Listagem de Entrada</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{url('/entradas')}}">Listagem Entradas</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Entradas</div>
                    <div class="card-body">
                        <a href="{{ url('/entradas/create') }}" class="btn btn-success btn-sm" title="Novo Entrada">
                            <i class="bi bi-plus-lg"></i> Novo
                        </a>

                        <form method="GET" action="{{ url('/entradas') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Buscar..." value="{{ request('search') }}">
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
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tipo de Entrada</th>
                                        <th>Valor</th>
                                        <th>Usuário</th>
                                        <th>Observação</th>
                                        <th>Tipo de Pagamento</th>
                                        <th>É metade?</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($entradas as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->tipo_entrada }}</td>
                                        <td>{{ $item->valor }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->observacao }}</td>
                                        <td>{{ $item->tipo_pagamento->nome }}</td>
                                        <td>{{$item->is_metade === 's' ? 'Sim' : 'Não'}}</td>

                                        <td>
                                            <a href="{{ url('/entradas/' . $item->id) }}" title="Ver Entrada"><button class="btn btn-info btn-sm"><i class="bi bi-eye"></i> Detalhes</button></a>
                                            <a href="{{ url('/entradas/' . $item->id . '/edit') }}" title="Editar Entrada"><button class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i> Atualizar</button></a>

                                            <form method="POST" action="{{ url('/entradas' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Deletar Entrada" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="bi bi-trash"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $entradas->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
