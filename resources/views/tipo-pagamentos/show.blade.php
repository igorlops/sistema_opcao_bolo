@extends('layouts.app')
@section('titulo_site','Detalhe pagamento')
@section('title')
    <h1>Listagem de Tipo de Pagamento</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{url('/tipo-pagamentos')}}">Listagem Tipo de Pagamento</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{url('/tipo-pagamentos/'.$tipopagamento->id)}}">Detalhes Tipo de Pagamento</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card bg-dark">
                    <div class="card-header">Tipo de Pagamento {{ $tipopagamento->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/tipo-pagamentos') }}" title="Back">@if(auth()->user()->type_user == "1") <button class="btn btn-warning btn-sm"><i class="bi bi-arrow-left"></i> Voltar</button>@endif</a>
                        <a href="{{ url('/tipo-pagamentos/' . $tipopagamento->id . '/edit') }}" title="Edit Tipo de Pagamento"><button class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i> Atualizar</button></a>

                        <form method="POST" action="{{ url('tipopagamentos' . '/' . $tipopagamento->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Tipo de Pagamento" onclick="return confirm(&quot;Tem certeza?&quot;)"><i class="bi bi-trash"></i> Apagar</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                             <table class="table table-dark table-hover">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $tipopagamento->id }}</td>
                                    </tr>
                                    <tr><th> Nome </th><td> {{ $tipopagamento->nome }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
