@extends('layouts.app')
@section('titulo_site','Novo produto')
@section('title')
    <h1>Novo Produto</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{url('/produtos')}}">Listagem de Produto</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{url('/produtos/create')}}">Novo Produto</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Novo Produto</div>
                    <div class="card-body">
                        <a href="{{ url('/produtos') }}" title="Back"><div class="botao-voltar"><button class="btn btn-warning btn-sm"><i class="bi bi-arrow-left"></i> Voltar</button></div></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/produtos') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('produtos.form', ['formMode' => 'create'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
