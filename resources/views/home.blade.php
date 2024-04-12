@extends('layouts.app')

@section('title','Dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card p-3">
                <div class="card-title py-3">
                    <h4>Pesquisar por usuário</h4>
                </div>
                <form method="GET">
                    <select name="user_id" class="form-select"
                    aria-label="Default select example">
                    <option selected>Nenhum selecionado</option>
                    @foreach ($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
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
                    <div class="card bg-primary p-3 my-3 flex-wrap text-center">
                        <i class="bi bi-boxes"></i>
                        <h4>Estoques</h4>
                        <h5>{{$venda ?? 0}}</h5>
                    </div>
                    <div class="card bg-success p-3 my-3 flex-wrap text-center ">
                        <i class="bi bi-cash-stack"></i>
                        <h4>Saldo atual</h4>
                    </div>
                    <div class="card bg-warning p-3 my-3 flex-wrap text-center ">
                        <i class="bi bi-cash-coin"></i>
                        <h4>Vendas</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
