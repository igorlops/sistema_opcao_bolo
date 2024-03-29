@extends('layouts.app')
@section('titulo_site','Laravel')
@section('title')
    <h1>Listagem de Entrada</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{url('/entradas')}}">Listagem Entrada</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{url('/entradas/'.$entrada->id)}}">Detalhes Entrada</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Entrada {{ $entrada->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/entradas') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>
                        <a href="{{ url('/entradas/' . $entrada->id . '/edit') }}" title="Edit Entrada"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Atualizar</button></a>

                        <form method="POST" action="{{ url('entradas' . '/' . $entrada->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Entrada" onclick="return confirm(&quot;Tem certeza?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Apagar</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $entrada->id }}</td>
                                    </tr>
                                    <tr><th> Tipo Entrada </th><td> {{ $entrada->tipo_entrada }} </td></tr><tr><th> Observacao </th><td> {{ $entrada->observacao }} </td></tr><tr><th> Id Tipo Pagamento </th><td> {{ $entrada->id_tipo_pagamento }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
