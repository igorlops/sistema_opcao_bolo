@extends('layouts.app')
@section('titulo_site','Cadastro de Estoque')
@section('title')
    <h1>Cadastro de Estoque</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{url('/estoque-produtos')}}">Lista de Cadastro de Estoque</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{url('/estoque-produtos/create')}}">Cadastro de Estoque</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card bg-dark">
                    <div class="card-header">Cadastro de Estoque</div>
                    <div class="card-body">
                        <a href="{{ url('/estoque-produtos') }}" title="Back">@if(auth()->user()->type_user == 1) <button class="btn btn-warning btn-sm"><i class="bi bi-arrow-left"></i> Voltar</button>@endif</a>
                        <br />
                        <br />
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <form method="POST" action="{{ url('/estoque-produtos') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @include ('estoque-produtos.form', ['formMode' => 'create'])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
