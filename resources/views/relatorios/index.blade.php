@extends('layouts.app')
@section('titulo_site','Relatório financeiro')
@section('title')
    <h1>Listagem de Movimentos Financeiros</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{url('/relatorios-financeiro')}}">Listagem Movimentos Financeiros</a>
    </li>
@endsection
@section('content')

    <div class="card bg-dark">
        <div class="p-3">
            <h4>Filtrar por data</h4>
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
                </div>
                <div class="py-3 col-sm-4">
                    <h4>Filtrar por usuário</h4>
                    <select class="form-select" name="usuario_select" id="usuario_select">
                        <option value="0" selected>Todos</option>
                        @foreach ($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="" class="control-label"></label>
                    <div class="input-group">
                        <button class="btn btn-primary m-t-xs" title="Buscar data" name="buscar_por_filtro" id="data_">Aplicar filtro</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="user-tab" data-bs-toggle="tab" data-bs-target="#user-tab-pane" type="button" role="tab" aria-controls="user-tab-pane" aria-selected="true">Usuários</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="in-out-tab" data-bs-toggle="tab" data-bs-target="#in-out-tab-pane" type="button" role="tab" aria-controls="in-out-tab-pane" aria-selected="false">Entradas/Saídas</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="totais-tab" data-bs-toggle="tab" data-bs-target="#totais-tab-pane" type="button" role="tab" aria-controls="totais-tab-pane" aria-selected="false">Totais</button>
        </li>
    </ul>

    {{-- Tab Panels --}}
    <div class="tab-content" id="myTabContent">

        {{-- Cards com detalhes das saidas por usuário --}}
        <div class="tab-pane fade show active" id="user-tab-pane" role="tabpanel" aria-labelledby="user-tab" tabindex="0">
            <div class="col-12 d-flex justify-content-around pt-5">
                @foreach ($results as $result)
                    <div class="card bg-dark">
                        <div class="card-body">
                            <div class="header"><strong>{{$result->name}}</strong></div>
                            <hr>
                            <p><strong>Total entradas:</strong> R$ {{numero_iso_para_br($result->total_entradas)}}</p>
                            <p><strong>Total saídas:</strong> R$ {{numero_iso_para_br($result->total_saidas)}}</p>
                            {{-- <a href="{{route('relatorios.user_details')}}/user/{{$user->id}}" class="btn btn-secondary">Ver mais</a> --}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Entradas e saidas --}}
        <div class="tab-pane fade" id="in-out-tab-pane" role="tabpanel" aria-labelledby="in-out-tab" tabindex="0">
            <h2 class="pt-5">Entradas</h2>
            <div class="table-responsive">
                 <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tipo</th>
                            <th>Usuário</th>
                            <th>Descricao</th>
                            <th>Valor</th>
                            <th>Data/Hora</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($entradas as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><span class="badge badge-success">Saídas</span></td>
                                <td>{{ $item->user->name}} </td>
                                <td>{{ $item->observacao }}</td>
                                <td>{{ numero_iso_para_br($item->valor) }}</td>
                                <td>{{ data_iso_para_br($item->created_at) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- <div class="pagination-wrapper"> {!! $entrada->appends(['search' => Request::get('search')])->render() !!} </div> --}}
            </div>

            <h2 class="pt-5">Saídas</h2>
            <div class="table-responsive">
                 <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tipo</th>
                            <th>Usuário</th>
                            <th>Descricao</th>
                            <th>Valor</th>
                            <th>Data/Hora</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($saidas as $saida)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><span class="badge badge-danger">Saída</span></td>
                                <td>{{ $saida->user->name }} </td>
                                <td>{{ $saida->observacao }}</td>
                                <td>{{ numero_iso_para_br($saida->valor) }}</td>
                                <td>{{ data_iso_para_br($saida->created_at) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- <div class="pagination-wrapper"> {!! $entrada->appends(['search' => Request::get('search')])->render() !!} </div> --}}
            </div>
        </div>
        <div class="tab-pane fade" id="totais-tab-pane" role="tabpanel" aria-labelledby="totais-tab" tabindex="0">
            <div class="pt-5">
                <div class="card bg-dark">
                    <div class="card-body">
                        <h5>
                            Totais acumulados
                        </h5>
                        <h5>Total de entrada: R$ {{$total_entradas}}</h5>
                        <h5>Total saída: R$: {{$total_saidas}}</h5>
                        <h5>Diferença entre total e saída: R$ {{$diferenca}}</h5>
                    </div>

                    <div class="p-3">
                        <h4>Relatórios gráficos</h4>
                        {{-- <canvas id="graficoEntradas"></canvas> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
