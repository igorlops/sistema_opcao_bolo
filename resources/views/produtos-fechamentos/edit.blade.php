@extends('layouts.app')
@section('titulo_site','Laravel')
@section('title')
    <h1>Editar ProdutosFechamento</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{url('/produtos-fechamentos')}}">Listagem de ProdutosFechamento</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{url('/produtos-fechamentos/' . $produtosfechamento->id. '/edit')}}">Editar ProdutosFechamento</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card bg-dark">
                    <div class="card-header">Editar ProdutosFechamento #{{ $produtosfechamento->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/produtos-fechamentos') }}" title="Back">@if(auth()->user()->type_user == "1") <button class="btn btn-warning btn-sm"><i class="bi bi-arrow-left"></i> Voltar</button>@endif</a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/produtos-fechamentos/' . $produtosfechamento->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('produtos-fechamentos.form', ['formMode' => 'edit'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
