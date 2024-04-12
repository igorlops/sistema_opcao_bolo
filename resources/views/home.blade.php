@extends('layouts.app')

@section('title','Dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <form method="GET">
                    <select name="user_id" class="form-select"
                    aria-label="Default select example">
                    <option selected>nenhum selecionado</option>
                    @foreach ($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">
                    Pesquisar
                </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
