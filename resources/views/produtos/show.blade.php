@extends('layouts.app')
@section('titulo_site','Detalhes do produto')
@section('title')
    <h1>Listagem de Produto</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{url('/produtos')}}">Listagem Produto</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{url('/produtos/'.$produto->id)}}">Detalhes Produto</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Produto {{ $produto->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/produtos') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="bi bi-arrow-left"></i> Voltar</button></a>
                        <a href="{{ url('/produtos/' . $produto->id . '/edit') }}" title="Edit Produto"><button class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i> Atualizar</button></a>

                        <form method="POST" action="{{ url('produtos' . '/' . $produto->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Produto" onclick="return confirm(&quot;Tem certeza?&quot;)"><i class="bi bi-trash"></i> Apagar</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $produto->id }}</td>
                                    </tr>
                                    <tr><th> Nome </th><td> {{ $produto->nome }} </td></tr><tr><th> É bolo extra? </th><td> {{ $produto->is_bolo_extra === 's' ? 'Sim' : 'Não' }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
