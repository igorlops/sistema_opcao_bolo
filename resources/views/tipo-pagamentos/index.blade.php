@extends('layouts.app')
@section('titulo_site','Laravel')
@section('title')
    <h1>Listagem de TipoPagamento</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{url('/tipo-pagamentos')}}">Listagem TipoPagamento</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Tipopagamentos</div>
                    <div class="card-body">
                        <a href="{{ url('/tipo-pagamentos/create') }}" class="btn btn-success btn-sm" title="Novo TipoPagamento">
                            <i class="fa fa-plus" aria-hidden="true"></i> Novo
                        </a>

                        <form method="GET" action="{{ url('/tipo-pagamentos') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Buscar..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
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
                                        <th>#</th><th>Nome</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($tipopagamentos as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nome }}</td>
                                        <td>
                                            <a href="{{ url('/tipo-pagamentos/' . $item->id) }}" title="View TipoPagamento"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Detalhes</button></a>
                                            <a href="{{ url('/tipo-pagamentos/' . $item->id . '/edit') }}" title="Edit TipoPagamento"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Atualizar</button></a>

                                            <form method="POST" action="{{ url('/tipo-pagamentos' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete TipoPagamento" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $tipopagamentos->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
