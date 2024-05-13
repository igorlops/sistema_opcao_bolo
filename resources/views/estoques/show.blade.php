@extends('layouts.app')
@section('titulo_site','Ver produção')
@section('title')
    <h1>Listagem de produção</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{url('/estoques')}}">Listagem produção</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{url('/estoques/'.$estoque->id)}}">Detalhes produção</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card bg-dark">
                    <div class="card-header">Produção {{ $estoque->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/estoques') }}" title="Back">@if(auth()->user()->type_user == "1") <button class="btn btn-warning btn-sm"><i class="bi bi-arrow-left"></i> Voltar</button>@endif</a>
                        <a href="{{ url('/estoques/' . $estoque->id . '/edit') }}" title="Editar produção"><button class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i> Atualizar</button></a>

                        <form method="POST" action="{{ url('estoques' . '/' . $estoque->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Deletar produção" onclick="return confirm(&quot;Tem certeza?&quot;)"><i class="bi bi-trash"></i> Apagar</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                             <table class="table table-dark table-hover">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $estoque->id }}</td>
                                    </tr>
                                    <tr><th> Tipo produção </th><td> {{ $estoque->tipo_estoque }} </td></tr><tr><th> Quantidade </th><td> {{ $estoque->quantidade }} </td></tr><tr><th> Id Produto </th><td> {{ $estoque->id_produto }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
