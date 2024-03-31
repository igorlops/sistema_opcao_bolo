@extends('layouts.app')
@section('titulo_site','Editar tipo de saida')
@section('title')
    <h1>Editar TipoSaida</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{url('/tipo-saidas')}}">Listagem de Tipo de Saida</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{url('/tipo-saidas/' . $tiposaida->id. '/edit')}}">Editar Tipo de Saida</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Editar Tipo de Saida #{{ $tiposaida->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/tipo-saidas') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="bi bi-arrow-left"></i> Voltar</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/tipo-saidas/' . $tiposaida->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('tipo-saidas.form', ['formMode' => 'edit'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
