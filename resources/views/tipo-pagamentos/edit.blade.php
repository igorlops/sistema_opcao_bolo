@extends('layouts.app')
@section('titulo_site','Editar pagamento')
@section('title')
    <h1>Editar TipoPagamento</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{url('/tipo-pagamentos')}}">Listagem de TipoPagamento</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{url('/tipo-pagamentos/' . $tipopagamento->id. '/edit')}}">Editar TipoPagamento</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Editar TipoPagamento #{{ $tipopagamento->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/tipo-pagamentos') }}" title="Back">@if(auth()->user()->type_user == "1") <button class="btn btn-warning btn-sm"><i class="bi bi-arrow-left"></i> Voltar</button>@endif</a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/tipo-pagamentos/' . $tipopagamento->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('tipo-pagamentos.form', ['formMode' => 'edit'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
