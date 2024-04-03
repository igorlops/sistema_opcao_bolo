@extends('layouts.app')
@section('titulo_site','Detalhe pagamento')
@section('title')
    <h1>Listagem de TipoPagamento</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{url('/tipo-pagamentos')}}">Listagem TipoPagamento</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{url('/tipo-pagamentos/'.$tipopagamento->id)}}">Detalhes TipoPagamento</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">TipoPagamento {{ $tipopagamento->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/tipo-pagamentos') }}" title="Back"><div class="botao-voltar"><button class="btn btn-warning btn-sm"><i class="bi bi-arrow-left"></i> Voltar</button></div></a>
                        <a href="{{ url('/tipo-pagamentos/' . $tipopagamento->id . '/edit') }}" title="Edit TipoPagamento"><button class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i> Atualizar</button></a>

                        <form method="POST" action="{{ url('tipopagamentos' . '/' . $tipopagamento->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete TipoPagamento" onclick="return confirm(&quot;Tem certeza?&quot;)"><i class="bi bi-trash"></i> Apagar</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
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
