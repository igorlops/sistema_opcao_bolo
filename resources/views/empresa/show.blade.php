@extends('layouts.app')

@section('title')
    <h3>Detalhes do {{$empresa->tipo}}: {{$empresa->nome}}</h3>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{route('empresas.index')}}?tipo={{$empresa->tipo}}">Listagem do {{$empresa->tipo}}</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{route('empresas.show',$empresa)}}">Detalhe {{$empresa->tipo}}</a>
    </li>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-globe"></i>
                                    {{$empresa->nome}}
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <strong>Razão Social</strong>: 
                                {{$empresa->razao_social}} <br>
                                <strong>CNPJ/CPF</strong>: 
                                {{$empresa->documento}} <br>
                                <strong>IE/RG</strong>: 
                                {{$empresa->ie_rg}} <br>
                            </div>
                            <div class="col-sm-6">
                                <address>
                                    {{$empresa->logradouro}},
                                    {{$empresa->bairro}},
                                    <br>
                                    {{$empresa->cidade}} -
                                    {{$empresa->estado}} -
                                    {{mascara($empresa->cep,"#####-###")}}
                                </address>
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="container">
                                
                            Nome Contato: {{$empresa->nome_contato}} <br>
                            Celular: {{mascara($empresa->celular, '(##) # ####-####')}} <br>
                            E-mail: {{$empresa->email}} <br>
                            Telefone: {{$empresa->telefone}} <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @include('empresa.parciais.movimentos_estoque')
        </div>

        <div class="row">
            <div class="col-sm-12">
                <form action="{{route('empresas.destroy',$empresa)}}?tipo={{$empresa->tipo}}" method="POST">
                    @method("DELETE")
                    @csrf
                    <button 
                        type="submit" 
                        class="btn btn-danger"
                        onclick="confirm('Tem certeza que deseja apagar?')">
                        Apagar
                    </button>
                </form>
            </div>
        </div>
    </div>
    
@endsection