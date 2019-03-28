@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                   @alert(['msg'=>session('msg'),'status'=>session('status')])
                   @endalert
                    <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Início</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Lista de Usuários</li>
                            </ol>
                    </nav>
                <form class="form-inline" method="GET" action="{{route('users.index')}}">
                            <div class="form-group mb-2">
                            <a href="{{route('register')}}">Adicionar</a>
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                            <input type="search" name="search" class="form-control" value="{{$search}}"/>
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">Buscar</button>
                            <a class="btn btn-outline-secondary mb-2 ml-1" href="{{route('users.index')}}" role="button">Limpar</a>

                    </form>
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nome</th>
                                <th scope="col">E-mail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($modelAll as $item)
                                <tr>
                                <th scope="row">{{$item->id}}</th>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @if(!$search && $modelAll)
                            <div>
                                {{$modelAll->links()}}
                            </div>
                        @endif
                       </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
