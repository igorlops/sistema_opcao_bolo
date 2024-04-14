@extends('layouts.app')
@section('titulo_site','Relatório financeiro')
@section('title')
    <h1>Listagem de Movimentos Financeiros</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{url('/relatorios-financeiro')}}">Listagem Movimentos Financeiros</a>
    </li>
@endsection
@section('content')

<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
            <div class="card bg-dark">
                <div class="card-header">saidas {{ $saidas->id }}</div>
                <div class="card-body">

                    <a href="{{ url('/saidass') }}" title="Back">@if(auth()->user()->type_user == "1") <button class="btn btn-warning btn-sm"><i class="bi bi-arrow-left"></i> Voltar</button>@endif</a>
                    <a href="{{ url('/saidas/' . $saidas->id . '/edit') }}" title="Edit saidas"><button class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i> Atualizar</button></a>

                    <form method="POST" action="{{ url('saidass' . '/' . $saidas->id) }}" accept-charset="UTF-8" style="display:inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger btn-sm" title="Delete saidas" onclick="return confirm(&quot;Tem certeza?&quot;)"><i class="bi bi-trash"></i> Apagar</button>
                    </form>
                    <br/>
                    <br/>

                    <div class="table-responsive">
                         <table class="table table-dark table-hover">
                            <tbody>
                                <tr>
                                    <th>ID</th><td>{{ $saidas->id }}</td>
                                </tr>
                                <tr><th> Total Vendas </th><td> {{ $saidas->observacao }} </td></tr><tr><th> Total Pagamentos </th><td> {{ $saidas->descricao->nome }} </td></tr><tr><th> Saldo Ini </th><td> {{ $saidas->id }} </td></tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
