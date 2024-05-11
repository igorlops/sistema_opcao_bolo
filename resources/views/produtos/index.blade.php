@extends('layouts.app')
@section('titulo_site','Produtos')
@section('title')
    <h1>Listagem de Produto</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{url('/produtos')}}">Listagem Produto</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card bg-dark">
                    <div class="card-header">Produtos para produção</div>
                    <div class="card-body">
                        <a href="{{ url('/produtos/create') }}" class="btn btn-success btn-sm" title="Novo Produto">
                            <i class="bi bi-plus-lg"></i> Novo
                        </a>

                        <form method="GET" action="{{ url('/produtos') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                        <th>#</th><th>Nome</th><th>É bolo extra?</th><th>Data</th><th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($produtos as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nome }}</td><td>{{ $item->is_bolo_extra === 's' ? "Sim" : "Não"}}</td>
                                        <td>{{ data_iso_para_br($item->created_at) }}</td>
                                        <td>
                                            <a href="{{ url('/produtos/' . $item->id) }}" title="Ver Produto"><button class="btn btn-info btn-sm"><i class="bi bi-eye"></i> Detalhes</button></a>
                                            <a href="{{ url('/produtos/' . $item->id . '/edit') }}" title="Editar Produto"><button class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i> Atualizar</button></a>

                                            <form method="POST" action="{{ url('/produtos' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Deletar Produto" onclick="return confirm(&quot;Confirma exclusão?&quot;)"><i class="bi bi-trash"></i> Deletar</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Não há dados cadastrados</td>
                                        <td></td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $produtos->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>
                    </div>
                </div>

                <div class="card bg-dark">
                    <div class="card-header">Produtos estoque</div>
                    <div class="card-body">
                        <div class="table-responsive">
                             <table class="table table-dark table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Nome</th><th>Data</th><th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($produtos_estoque as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nome }}</td>
                                        <td>{{ data_iso_para_br($item->created_at) }}</td>
                                        <td>
                                            <a href="{{ url('/produtos/' . $item->id) }}" title="Ver Produto"><button class="btn btn-info btn-sm"><i class="bi bi-eye"></i> Detalhes</button></a>
                                            <a href="{{ url('/produtos/' . $item->id . '/edit') }}" title="Editar Produto"><button class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i> Atualizar</button></a>

                                            <form method="POST" action="{{ url('/produtos' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Deletar Produto" onclick="return confirm(&quot;Confirma exclusão?&quot;)"><i class="bi bi-trash"></i> Deletar</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Não há dados cadastrados</td>
                                        <td></td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $produtos->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
