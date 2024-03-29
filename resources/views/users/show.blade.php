@extends('layouts.app')
@section('titulo_site','Laravel')
@section('title')
    <h1>Listagem de User</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{url('/users')}}">Listagem User</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{url('/users/'.$user->id)}}">Detalhes User</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">User {{ $user->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/users') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>
                        <a href="{{ url('/users/' . $user->id . '/edit') }}" title="Edit User"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Atualizar</button></a>

                        <form method="POST" action="{{ url('users' . '/' . $user->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete User" onclick="return confirm(&quot;Tem certeza?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Apagar</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $user->id }}</td>
                                    </tr>
                                    <tr><th> Nome </th><td> {{ $user->name }} </td></tr><tr><th> Email </th><td> {{ $user->email }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
