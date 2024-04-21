@extends('layouts.app')
@section('titulo_site','Laravel')
@section('title')
    <h1>Listagem de Fechamento</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{url('/fechamentos')}}">Listagem Fechamento</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{url('/fechamentos/'.$fechamento->id)}}">Detalhes Fechamento</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card bg-dark">
                    <div class="card-header">Fechamento {{ $fechamento->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/fechamentos') }}" title="Back">@if(auth()->user()->type_user == "1") <button class="btn btn-warning btn-sm"><i class="bi bi-arrow-left"></i> Voltar</button>@endif</a>
                        <a href="{{ url('/fechamentos/' . $fechamento->id . '/edit') }}" title="Edit Fechamento"><button class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i> Atualizar</button></a>

                        <form method="POST" action="{{ url('fechamentos' . '/' . $fechamento->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Fechamento" onclick="return confirm(&quot;Tem certeza?&quot;)"><i class="bi bi-trash"></i> Apagar</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                             <table class="table table-dark table-hover">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $fechamento->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> Vendas Extras </th>
                                        <td> {{ $fechamento->vendas_extras }} </td>
                                    </tr>
                                    <tr>
                                        <th> Desconto </th>
                                        <td> {{ $fechamento->desconto }} </td>
                                    </tr>
                                    <tr>
                                        <th> Vendas ABC </th>
                                        <td> {{ $fechamento->vendas_abc }} </td>
                                    </tr>
                                    <tr>
                                        <th> Env.: </th>
                                        <td> {{ $fechamento->env }} </td>
                                    </tr>
                                    <tr>
                                        <th> Cartão de crédito </th>
                                        <td> {{ $fechamento->cartao_cred }} </td>
                                    </tr>
                                    <tr>
                                        <th> Cartão de débito </th>
                                        <td> {{ $fechamento->cartao_deb }} </td>
                                    </tr>
                                    <tr>
                                        <th> Pix </th>
                                        <td> {{ $fechamento->pix }} </td>
                                    </tr>
                                    <tr>
                                        <th> Total caixa</th>
                                        <td> {{ $fechamento->total_caixa }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <h3>Resumo do fechamento:</h3>
                        <div class="table-responsive">
                            <table class="table table-dark table-hover">
                               <tbody>
                                   <tr>
                                       <th>ID</th><td>{{ $fechamento->id }}</td>
                                   </tr>
                                   <tr>
                                       <th> Vendas Extras </th>
                                       <td> {{ $fechamento->vendas_extras }} </td>
                                   </tr>
                                   <tr>
                                       <th> Desconto </th>
                                       <td> {{ $fechamento->desconto }} </td>
                                   </tr>
                                   <tr>
                                       <th> Vendas ABC </th>
                                       <td> {{ $fechamento->vendas_abc }} </td>
                                   </tr>
                                   <tr>
                                       <th> Env.: </th>
                                       <td> {{ $fechamento->env }} </td>
                                   </tr>
                                   <tr>
                                       <th> Cartão de crédito </th>
                                       <td> {{ $fechamento->cartao_cred }} </td>
                                   </tr>
                                   <tr>
                                       <th> Cartão de débito </th>
                                       <td> {{ $fechamento->cartao_deb }} </td>
                                   </tr>
                                   <tr>
                                       <th> Pix </th>
                                       <td> {{ $fechamento->pix }} </td>
                                   </tr>
                                   <tr>
                                       <th> Total caixa</th>
                                       <td> {{ $fechamento->total_caixa }} </td>
                                   </tr>
                               </tbody>
                           </table>
                       </div>
                        @foreach ($produtos_fechamentos as $produto)

                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
