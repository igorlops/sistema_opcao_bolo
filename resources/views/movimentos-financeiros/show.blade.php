@extends('layouts.app')

@section('title')
    <h1>Listagem de Movimento Financeiro</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{url('/movimentos-financeiros')}}">Listagem Movimentos Financeiros</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{url('/movimentos-financeiros/'.$movimentos_financeiro->id)}}">Detalhes Movimentos Financeiros</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Movimento Financeiro {{ $movimentos_financeiro->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/movimentos-financeiros') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>
                        <a href="{{ url('/movimentos-financeiros/' . $movimentos_financeiro->id . '/edit') }}" title="Edit Movimentos_Financeiro"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Atualizar</button></a>

                        <form method="POST" action="{{ url('movimentos_financeiros' . '/' . $movimentos_financeiro->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Movimentos_Financeiro" onclick="return confirm(&quot;Tem certeza?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Apagar</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $movimentos_financeiro->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tipo</th>
                                        <td><span class="badge badge-{{ ucfirst($movimentos_financeiro->tipo) == 'Saida' ? 'danger' : 'success' }}">{{ ucfirst($movimentos_financeiro->tipo) }}</span></td>
                                    </tr>
                                    <tr>
                                        <th>Empresa</th>
                                        <td>{{ $movimentos_financeiro->empresa->nome }} ({{$movimentos_financeiro->empresa->razao_social}})</td>
                                    </tr>
                                    <tr>
                                        <th> Descricao </th>
                                        <td> {{ $movimentos_financeiro->descricao }} </td>
                                    </tr>
                                        <tr>
                                            <th> Valor </th>
                                            <td>R$ {{ numero_iso_para_br($movimentos_financeiro->valor) }} </td>
                                        </tr>
                                        <tr>
                                            <th> Data </th>
                                            <td> {{ data_iso_para_br($movimentos_financeiro->data) }} </td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
