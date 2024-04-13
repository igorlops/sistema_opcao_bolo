@extends('layouts.app')
@section('titulo_site','Detalhes tipo de saída')
@section('title')
    <h1>Listagem de TipoSaida</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{url('/tipo-saidas')}}">Listagem Tipo de Saida</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{url('/tipo-saidas/'.$tiposaida->id)}}">Detalhes Tipo de Saida</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card bg-dark">
                    <div class="card-header">Tipos de Saidas {{ $tiposaida->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/tipo-saidas') }}" title="Back">@if(auth()->user()->type_user == "1") <button class="btn btn-warning btn-sm"><i class="bi bi-arrow-left"></i> Voltar</button>@endif</a>
                        <a href="{{ url('/tipo-saidas/' . $tiposaida->id . '/edit') }}" title="Edit TipoSaida"><button class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i> Atualizar</button></a>

                        <form method="POST" action="{{ url('tiposaidas' . '/' . $tiposaida->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete TipoSaida" onclick="return confirm(&quot;Tem certeza?&quot;)"><i class="bi bi-trash"></i> Apagar</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $tiposaida->id }}</td>
                                    </tr>
                                    <tr><th> Descricao </th><td> {{ $tiposaida->descricao }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
