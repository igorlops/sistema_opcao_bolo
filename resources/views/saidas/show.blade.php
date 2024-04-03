@extends('layouts.app')
@section('titulo_site','Detalhes saída')
@section('title')
    <h1>Listagem de Saida</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{url('/saidas')}}">Listagem Saida</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{url('/saidas/'.$saida->id)}}">Detalhes Saida</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Saida {{ $saida->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/saidas') }}" title="Back"><div class="botao-voltar"><button class="btn btn-warning btn-sm"><i class="bi bi-arrow-left"></i> Voltar</button></div></a>
                        <a href="{{ url('/saidas/' . $saida->id . '/edit') }}" title="Edit Saida"><button class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i> Atualizar</button></a>

                        <form method="POST" action="{{ url('saidas' . '/' . $saida->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Saida" onclick="return confirm(&quot;Tem certeza?&quot;)"><i class="bi bi-trash"></i> Apagar</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $saida->id }}</td>
                                    </tr>
                                    <tr><th> Valor </th><td> {{ $saida->valor }} </td></tr><tr><th> Observacao </th><td> {{ $saida->observacao }} </td></tr><tr><th> User Id </th><td> {{ $saida->user_id }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
