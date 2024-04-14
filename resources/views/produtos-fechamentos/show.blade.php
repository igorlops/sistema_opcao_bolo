@extends('layouts.app')
@section('titulo_site','Laravel')
@section('title')
    <h1>Listagem de ProdutosFechamento</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{url('/produtos-fechamentos')}}">Listagem ProdutosFechamento</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{url('/produtos-fechamentos/'.$produtosfechamento->id)}}">Detalhes ProdutosFechamento</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card bg-dark">
                    <div class="card-header">ProdutosFechamento {{ $produtosfechamento->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/produtos-fechamentos') }}" title="Back">@if(auth()->user()->type_user == "1") <button class="btn btn-warning btn-sm"><i class="bi bi-arrow-left"></i> Voltar</button>@endif</a>
                        <a href="{{ url('/produtos-fechamentos/' . $produtosfechamento->id . '/edit') }}" title="Edit ProdutosFechamento"><button class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i> Atualizar</button></a>

                        <form method="POST" action="{{ url('produtosfechamentos' . '/' . $produtosfechamento->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete ProdutosFechamento" onclick="return confirm(&quot;Tem certeza?&quot;)"><i class="bi bi-trash"></i> Apagar</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                             <table class="table table-dark table-hover">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $produtosfechamento->id }}</td>
                                    </tr>
                                    <tr><th> Producao </th><td> {{ $produtosfechamento->producao }} </td></tr><tr><th> Desperdicio </th><td> {{ $produtosfechamento->desperdicio }} </td></tr><tr><th> Sobra </th><td> {{ $produtosfechamento->sobra }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
