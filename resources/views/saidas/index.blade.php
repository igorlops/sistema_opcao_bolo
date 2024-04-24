@extends('layouts.app')
@section('titulo_site','Saídas')
@section('title')
    <h1>Listagem de Saida</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{url('/saidas')}}">Listagem Saida</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card bg-dark">
                    <div class="card-header">Saidas</div>
                    <div class="card-body">
                        <a href="{{ url('/saidas/create') }}" class="btn btn-success btn-sm" title="Novo Saida">
                            <i class="bi bi-plus-lg"></i> Novo
                        </a>

                        <form method="GET" action="{{ url('/saidas') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Buscar..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                             <table class="table table-dark table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Valor</th><th>Usuário</th><th>Observação</th><th>Tipo de saída</th><th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($saidas as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ numero_iso_para_br($item->valor) }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->observacao }}</td>
                                        <td>{{ $item->tipo_saida->descricao }}</td>
                                        <td>
                                            <a href="{{ url('/saidas/' . $item->id) }}" title="View Saida"><button class="btn btn-info btn-sm"><i class="bi bi-eye"></i> Detalhes</button></a>
                                            <a href="{{ url('/saidas/' . $item->id . '/edit') }}" title="Edit Saida"><button class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i> Atualizar</button></a>

                                            <form method="POST" action="{{ url('/saidas' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Saida" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="bi bi-trash"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Não há dados cadastrados</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $saidas->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
