@extends('layouts.app')

@section('title')
    <h1>Listagem de Movimentos Financeiros</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{url('/movimentos-financeiros')}}">Listagem Movimentos Financeiros</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Movimentos Financeiros</div>
                    <div class="card-body">
                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="data_inicial" class="control-label">Data inicial</label>
                                        <div class="input-group">
                                            <input class="form-control date" type="text" name="data_inicial" value="{{request('data_inicial')}}" id="data_inicial">
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label" for="data_final">Data final</label>
                                        <div class="input-group">
                                            <input class="form-control date" type="text" name="data_final" value="{{request('data_final')}}" id="data_final">
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="" class="control-label"></label>
                                        <div class="input-group">
                                            <button class="btn btn-info m-t-xs" title="Buscar data" name="" id="data_">Buscar data</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tipo</th>
                                        <th>Empresa</th>
                                        <th>Descricao</th>
                                        <th>Valor</th>
                                        <th>Data</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($movimentos_financeiros as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><span class="badge badge-{{ ucfirst($item->tipo) == 'Saida' ? 'danger' : 'success' }}">{{ ucfirst($item->tipo) }}</span></td>
                                        <td>{{ $item->empresa->nome }} ({{$item->empresa->razao_social}})</td>
                                        <td>{{ $item->descricao }}</td>
                                        <td>{{ numero_iso_para_br($item->valor) }}</td>
                                        <td>{{ data_iso_para_br($item->data) }}</td>
                                        <td>
                                            <a href="{{ url('/movimentos-financeiros/' . $item->id) }}" title="View Movimentos_Financeiro"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Detalhes</button></a>
                                            <a href="{{ url('/movimentos-financeiros/' . $item->id . '/edit') }}" title="Edit Movimentos_Financeiro"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Atualizar</button></a>

                                            <form method="POST" action="{{ url('/movimentos-financeiros' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Movimentos_Financeiro" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <a href="{{ url('/movimentos-financeiros/create') }}" class="btn btn-success btn-sm" title="Novo Movimento Financeiro">
                                <i class="fa fa-plus" aria-hidden="true"></i> Novo
                            </a>
                            <div class="pagination-wrapper"> {!! $movimentos_financeiros->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
