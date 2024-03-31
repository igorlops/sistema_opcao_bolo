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
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
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
                            <div class="py-3">
                                <h4>Filtrar por usuário</h4>
                                <select class="form-select col-2" name="usuario_select" id="usuario_select">
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
                <div class="card">
                    <div class="card-header">Movimentos Financeiros</div>
                    <div class="card-body">
                        <div class="p-3">
                            <h5>
                                Totais acumulados
                            </h5>
                            <h5>Total de entrada: R$ {{$total_entradas}}</h5>
                            <h5>Total saída: R$: {{$total_saidas}}</h5>
                            <h5>Diferença entre total e saída: R$ {{$diferenca}}</h5>
                        </div>

                        <div class="p-3">
                            <h4>Relatórios gráficos</h4>
                            <canvas id="graficoEntradas"></canvas>
                        </div>

                        <h2 class="pt-5">Entradas</h2>
                        <div class="table-responsive">
                            <table class="table">
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
                                @foreach($entrada as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><span class="badge badge-success">Venda</span></td>
                                        <td>{{ $item->user->nome }} </td>
                                        <td>{{ $item->observacao }}</td>
                                        <td>{{ numero_iso_para_br($item->valor) }}</td>
                                        <td>{{ data_iso_para_br($item->created_at) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{-- <div class="pagination-wrapper"> {!! $entrada->appends(['search' => Request::get('search')])->render() !!} </div> --}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Exemplo de dados para o gráfico de entradas
        var dadosEntradas = @json($dadosEntradas); // Supondo que $dadosEntradas seja um array de dados vindo do seu controlador

        var ctx = document.getElementById('graficoEntradas').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: dadosEntradas.labels,
                datasets: [{
                    label: 'Total de Entradas',
                    data: dadosEntradas.valores,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

@endsection
