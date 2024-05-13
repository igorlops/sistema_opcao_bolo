@extends('layouts.app')
@section('titulo_site','Editar saída')
@section('title')
    <h1>Editar Saida</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{url('/saidas')}}">Listagem de Saida</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{url('/saidas/' . $saida->id. '/edit')}}">Editar Saida</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card bg-dark">
                    <div class="card-header">Editar Saida #{{ $saida->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/saidas') . '?tipo=fixo' }}" title="Back">@if(auth()->user()->type_user == "1") <button class="btn btn-warning btn-sm"><i class="bi bi-arrow-left"></i> Voltar</button>@endif</a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/saidas/' . $saida->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('saidas-fixas.form', ['formMode' => 'edit'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
