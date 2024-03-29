@extends('layouts.app')
@section('titulo_site','Laravel')
@section('title')
    <h1>Listagem de TipoSaida</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{url('/tipo-saidas')}}">Listagem TipoSaida</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{url('/tipo-saidas/'.$tiposaida->id)}}">Detalhes TipoSaida</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">TipoSaida {{ $tiposaida->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/tipo-saidas') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>
                        <a href="{{ url('/tipo-saidas/' . $tiposaida->id . '/edit') }}" title="Edit TipoSaida"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Atualizar</button></a>

                        <form method="POST" action="{{ url('tiposaidas' . '/' . $tiposaida->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete TipoSaida" onclick="return confirm(&quot;Tem certeza?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Apagar</button>
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
