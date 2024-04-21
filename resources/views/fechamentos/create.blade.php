@extends('layouts.app')
@section('titulo_site','Laravel')
@section('title')
    <h1>Novo Fechamento</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{url('/fechamentos')}}">Listagem de Fechamento</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{url('/fechamentos/create')}}">Novo Fechamento</a>
    </li>
    @endsection
    @section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card bg-dark">
                    <div class="card-header">Novo Fechamento</div>
                    <div class="card-body">
                        <a href="{{ url('/fechamentos') }}" title="Back">@if(auth()->user()->type_user == "1") <button class="btn btn-warning btn-sm"><i class="bi bi-arrow-left"></i> Voltar</button>@endif</a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <h1>Relatório de produção atual</h1>

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

                        <form method="POST" action="{{ url('/fechamentos') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('fechamentos.form', ['formMode' => 'create'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
