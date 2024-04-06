@extends('layouts.app')
@section('titulo_site','Laravel')
@section('title')
    <h1>Listagem de Estoque</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{url('/estoques')}}">Listagem Estoque</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{url('/estoques/'.$estoque->id)}}">Detalhes Estoque</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Estoque {{ $estoque->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/estoques') }}" title="Back">@if(auth()->user()->type_user == "1") <button class="btn btn-warning btn-sm"><i class="bi bi-arrow-left"></i> Voltar</button>@endif</a>
                        <a href="{{ url('/estoques/' . $estoque->id . '/edit') }}" title="Edit Estoque"><button class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i> Atualizar</button></a>

                        <form method="POST" action="{{ url('estoques' . '/' . $estoque->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Estoque" onclick="return confirm(&quot;Tem certeza?&quot;)"><i class="bi bi-trash"></i> Apagar</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $estoque->id }}</td>
                                    </tr>
                                    <tr><th> Tipo Estoque </th><td> {{ $estoque->tipo_estoque }} </td></tr><tr><th> Quantidade </th><td> {{ $estoque->quantidade }} </td></tr><tr><th> Id Produto </th><td> {{ $estoque->id_produto }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
