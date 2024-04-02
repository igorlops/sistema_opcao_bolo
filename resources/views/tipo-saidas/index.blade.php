@extends('layouts.app')
@section('titulo_site','Tipos de saídas')
@section('title')
    <h1>Listagem de Tipo de Saida</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{url('/tipo-saidas')}}">Listagem Tipo de Saida</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Tipo de saidas</div>
                    <div class="card-body">
                        <a href="{{ url('/tipo-saidas/create') }}" class="btn btn-success btn-sm" title="Novo TipoSaida">
                            <i class="bi bi-plus-lg"></i> Novo
                        </a>

                        <form method="GET" action="{{ url('/tipo-saidas') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Descricao</th><th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($tiposaidas as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->descricao }}</td>
                                        <td>
                                            <a href="{{ url('/tipo-saidas/' . $item->id) }}" title="View Tipo Saida"><button class="btn btn-info btn-sm"><i class="bi bi-eye"></i> Detalhes</button></a>
                                            <a href="{{ url('/tipo-saidas/' . $item->id . '/edit') }}" title="Edit Tipo Saida"><button class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i> Atualizar</button></a>

                                            <form method="POST" action="{{ url('/tipo-saidas' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete TipoSaida" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="bi bi-trash"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $tiposaidas->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
