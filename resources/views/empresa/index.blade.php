@extends('layouts.app')

@section('title')
    <h1>Listagem de empresas</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{route('empresas.index')}}?tipo={{$tipo}}">Listagem</a>
    </li>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Listagem de {{$tipo}}</div>
                        <div class="card-tools">
                            <a href="{{route('empresas.create')}}?tipo={{$tipo}}" class="btn btn-success">Novo {{$tipo}}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Nome Empresa</th>
                                    <th>Nome Contato:</th>
                                    <th>Celular</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($empresas as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->nome}}</td>
                                    <td>{{$item->nome_contato}}</td>
                                    <td>{{$item->celular}}</td>
                                    <td>
                                        <a href="{{route('empresas.show',$item)}}" class="btn btn-info">
                                            Detalhes
                                        </a>
                                        <a href="{{route('empresas.edit',$item)}}" class="btn btn-primary">
                                            Atualizar
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>Nenhum {{$tipo}} cadastrado</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                @endforelse
                            </tbody>
                          </table>
                    </div>
                    <div class="card-footer clearfix">
                        {{ $empresas->appends(['tipo'=>request('tipo')])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection