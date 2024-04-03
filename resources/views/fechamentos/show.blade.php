@extends('layouts.app')
@section('titulo_site','Detalhe fechamento')
@section('title')
    <h1>Listagem de Fechamento</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{url('/fechamentos')}}">Listagem Fechamento</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{url('/fechamentos/'.$fechamento->id)}}">Detalhes Fechamento</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Fechamento {{ $fechamento->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/fechamentos') }}" title="Back"><div class="botao-voltar"><button class="btn btn-warning btn-sm"><i class="bi bi-arrow-left"></i> Voltar</button></div></a>
                        <a href="{{ url('/fechamentos/' . $fechamento->id . '/edit') }}" title="Edit Fechamento"><button class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i> Atualizar</button></a>

                        <form method="POST" action="{{ url('fechamentos' . '/' . $fechamento->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Fechamento" onclick="return confirm(&quot;Tem certeza?&quot;)"><i class="bi bi-trash"></i> Apagar</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $fechamento->id }}</td>
                                    </tr>
                                    <tr><th> Total Vendas </th><td> {{ $fechamento->total_vendas }} </td></tr><tr><th> Total Pagamentos </th><td> {{ $fechamento->total_pagamentos }} </td></tr><tr><th> Saldo Ini </th><td> {{ $fechamento->saldo_ini }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
