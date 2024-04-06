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
                <div class="card">
                    <div class="card-header">Fechamentos</div>
                    <div class="card-body">
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

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Vendas Extras</th><th>Desconto</th><th>Vendas Abc</th><th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($fechamentos as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->vendas_extras }}</td><td>{{ $item->desconto }}</td><td>{{ $item->vendas_abc }}</td>
                                        <td>
                                            <a href="{{ url('/fechamentos/' . $item->id) }}" title="View Fechamento"><button class="btn btn-info btn-sm"><i class="bi bi-eye"></i> Detalhes</button></a>
                                            <a href="{{ url('/fechamentos/' . $item->id . '/edit') }}" title="Edit Fechamento"><button class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i> Atualizar</button></a>

                                            <form method="POST" action="{{ url('/fechamentos' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Fechamento" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="bi bi-trash"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $fechamentos->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
