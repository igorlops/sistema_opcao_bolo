@extends('layouts.app')
@section('titulo_site','Editar entrada')
@section('title')
    <h1>Editar Entrada</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{url('/entradas')}}">Listagem de Entradas</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{url('/entradas/' . $entrada->id. '/edit')}}">Editar Entradas</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Editara Entrada #{{ $entrada->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/entradas') }}" title="Back"><div class="botao-voltar"><button class="btn btn-warning btn-sm"><i class="bi bi-arrow-left"></i> Voltar</button></div></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/entradas/' . $entrada->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('entradas.form', ['formMode' => 'edit'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
