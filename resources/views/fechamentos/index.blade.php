@extends('layouts.app')
@section('titulo_site','Laravel')
@section('title')
    <h1>Listagem de Fechamento</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{url('/fechamentos')}}">Listagem Fechamento</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="mb-3 d-flex align-items-center justify-content-between">
                    <a href="{{ url('/fechamentos/create') }}" class="btn btn-success btn-sm" title="Novo Fechamento">
                        <i class="bi bi-plus-lg"></i> Novo
                    </a>
                    <form method="GET" action="{{ url('/fechamentos') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Buscar..." value="{{ request('search') }}">
                            <span class="input-group-append">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="card bg-dark">
                    <div class="card-header">Fechamentos pendentes</div>
                    <div class="card-body">
                        <div class="table-responsive">
                             <table class="table table-warning table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Data</th>
                                        <th>Usuário</th>
                                        <th>Cartão de crédito</th>
                                        <th>Cartão de débito</th>
                                        <th>Pix</th>
                                        <th>Desconto</th>
                                        <th>Vendas Extras</th>
                                        <th>Vendas ABC</th>
                                        <th>Observação</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($fechamentosPendentes as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ data_iso_para_br($item->created_at) }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ numero_iso_para_br($item->cartao_cred) }}</td>
                                        <td>{{ numero_iso_para_br($item->cartao_deb) }}</td>
                                        <td>{{ numero_iso_para_br($item->pix) }}</td>
                                        <td>{{ numero_iso_para_br($item->vendas_extras) }}</td>
                                        <td>{{ numero_iso_para_br($item->desconto) }}</td>
                                        <td>{{ numero_iso_para_br($item->vendas_abc) }}</td>
                                        <td>{{ $item->observacao }}</td>
                                        <td>
                                            <a href="{{ url('/fechamentos/' . $item->id) }}" title="Ver Fechamento"><button class="btn btn-info btn-sm"><i class="bi bi-eye"></i> Detalhes</button></a>
                                            <a href="{{ url('/fechamentos/' . $item->id . '/edit') }}" title="Editar Fechamento"><button class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i> Atualizar</button></a>

                                            <form method="POST" action="{{ url('/fechamentos' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Deletar Fechamento" onclick="return confirm(&quot;Confirma exclusão?&quot;)"><i class="bi bi-trash"></i> Deletar</button>
                                            </form>
                                            <form method="POST" action="{{ url('/aprova-fechamento'. '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('POST') }}
                                                {{ csrf_field() }}
                                                <input type="hidden" name="ativo" value="s">
                                                <button type="submit" class="btn btn-success btn-sm" title="Aprovar Fechamento" onclick="return confirm(&quot;Confirma aprovação?&quot;)"><i class="bi bi-check"></i></button>
                                            </form>

                                        </td>
                                    </tr>
                                    @empty

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Não há dados cadastrados</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>

                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $fechamentosPendentes->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>


                <div class="card bg-dark">
                    <div class="card-header">Fechamentos aprovados</div>
                    <div class="card-body">
                        <div class="table-responsive">
                             <table class="table table-success table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Data</th>
                                        <th>Usuário</th>
                                        <th>Cartão de crédito</th>
                                        <th>Cartão de débito</th>
                                        <th>Pix</th>
                                        <th>Desconto</th>
                                        <th>Vendas Extras</th>
                                        <th>Vendas ABC</th>
                                        <th>Observação</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($fechamentosAprovados as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ data_iso_para_br($item->created_at) }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ numero_iso_para_br($item->cartao_cred) }}</td>
                                        <td>{{ numero_iso_para_br($item->cartao_deb) }}</td>
                                        <td>{{ numero_iso_para_br($item->pix) }}</td>
                                        <td>{{ numero_iso_para_br($item->vendas_extras) }}</td>
                                        <td>{{ numero_iso_para_br($item->desconto) }}</td>
                                        <td>{{ numero_iso_para_br($item->vendas_abc) }}</td>
                                        <td>{{ numero_iso_para_br($item->vendas_abc) }}</td>
                                        <td>{{ $item->observacao }}</td>
                                        <td>
                                            <a href="{{ url('/fechamentos/' . $item->id) }}" title="Ver Fechamento"><button class="btn btn-info btn-sm"><i class="bi bi-eye"></i> Detalhes</button></a>
                                            <a href="{{ url('/fechamentos/' . $item->id . '/edit') }}" title="Editar Fechamento"><button class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i> Atualizar</button></a>

                                            <form method="POST" action="{{ url('/fechamentos' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Deletar Fechamento" onclick="return confirm(&quot;Confirma exclusão?&quot;)"><i class="bi bi-trash"></i> Deletar</button>
                                            </form>

                                        </td>
                                    </tr>
                                    @empty

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Não há dados cadastrados</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>

                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $fechamentosAprovados->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
