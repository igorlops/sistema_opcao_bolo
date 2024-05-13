@extends('layouts.app')
@section('titulo_site','Edita estoque')
@section('title')
    <h1>Editar estoque</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{url('/estoque-produtos')}}">Listagem de estoque</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{url('/estoque-produtos/' . $estoque->id. '/edit')}}">Editar estoque</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card bg-dark">
                    <div class="card-header">Editar estoque #{{ $estoque->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/estoque-produtos') }}" title="Back">@if(auth()->user()->type_user == "1") <button class="btn btn-warning btn-sm"><i class="bi bi-arrow-left"></i> Voltar</button>@endif</a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/estoque-produtos/' . $estoque->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('estoque-produtos.form', ['formMode' => 'edit'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
