@extends('layouts.app')

@section('title','Dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <h1 class="text-dark text-center pb-3">Resumo do mês de {{$mes}}</h1>
            <div class="card p-3">
                <div class="card-title py-3">
                    <h5>Filtrar pesquisa</h5>
                </div>
                <form method="GET">
                <div class="d-flex justify-content-center flex-row">
                    @if (auth()->user()->type_user == 1)
                    <div class="col-sm-4 mb-3">
                        <label for="data_ini_home" class="control-label">Selecione usuário</label>
                        <select name="user_id" class="form-select"
                            aria-label="Default select example">
                            <option selected>Nenhum selecionado</option>
                            @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    @endif

                    <div class="col-sm-4 mb-3">
                        <div class="form-group">
                            <label for="data_ini_home" class="control-label">Data inicial</label>
                            <div class="input-group">
                                <input class="form-control date" type="text" name="data_ini_home" value="{{request('data_ini_home')}}" id="data_ini_home">
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <div class="form-group">
                            <label class="control-label" for="data_fin_home">Data final</label>
                            <div class="input-group">
                                <input class="form-control date" type="text" name="data_fin_home" value="{{request('data_fin_home')}}" id="data_fin_home">
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">
                    Pesquisar
                </button>
                </form>
            </div>
            <div class="card p-3 mt-3">
                <div class="card-title py-3 text-center">
                    <h4>Resumo</h4>
                </div>
                <div class="d-flex justify-content-around">
                    <a class="btn btn-primary p-3 my-3 flex-wrap text-center" href="{{route('estoques.index')}}">
                        <i class="bi bi-boxes"></i>
                        <h4>Estoques</h4>
                        <h5>{{numero_iso_para_br($sobra)}}</h5>
                    </a>
                    <a class="btn btn-success p-3 my-3 flex-wrap text-center " href="{{route('relatorios.index')}}">
                        <i class="bi bi-cash-stack"></i>
                        <h4>Saldo atual</h4>
                        {{-- <h5>R$ {{numero_iso_para_br($entradas->total_entradas - $saidas->total_saidas)}}</h5> --}}
                    </a>
                    <a class="btn btn-warning p-3 my-3 flex-wrap text-center " href="{{route('entradas.index')}}">
                        <i class="bi bi-cash-coin"></i>
                        <h4>Vendas</h4>
                        {{-- <h5>{{$produtos->venda}}</h5> --}}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
