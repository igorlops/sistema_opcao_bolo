@extends('layouts.app')
@section('titulo_site','Usuários')
@section('title')
    <h1>Listagem de User</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{url('/users')}}">Listagem Usuários</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card bg-dark">
                    <div class="card-header">Usuários</div>
                    <div class="card-body">
                        <a href="{{ url('/users/create') }}" class="btn btn-success btn-sm" title="Novo User">
                            <i class="bi bi-plus-lg"></i> Novo
                        </a>

                        <form method="GET" action="{{ url('/users') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                        <th>#</th><th>Nome</th><th>Email</th><th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($users as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td><td>{{ $item->email }}</td>
                                        <td>
                                            <a href="{{ url('/users/' . $item->id) }}" title="Ver User"><button class="btn btn-info btn-sm"><i class="bi bi-eye"></i> Detalhes</button></a>
                                            <a href="{{ url('/users/' . $item->id . '/edit') }}" title="Editar User"><button class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i> Atualizar</button></a>

                                            <form method="POST" action="{{ url('/users' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Deletar User" onclick="return confirm(&quot;Confirma exclusão?&quot;)"><i class="bi bi-trash"></i> Deletar</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty

                                    <tr>
                                        <td></td>
                                        <td>Não há dados cadastrados</td>
                                        <td></td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $users->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
