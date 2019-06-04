@extends('layouts.app')

@section('content')

    @page(['col'=>12, 'name'=>'Info users'])

        @alert(['msg'=>session('msg'),'status'=>session('status')])
        @endalert
        <p><span class="badge badge-warning">Title: </span> {{$register->title}}</p>
        <p><span class="badge badge-warning">Stadium: </span> {{$register->stadium}}</p>
        <p><span class="badge badge-warning">Team A: </span> {{$register->team_a}}</p>
        <p><span class="badge badge-warning">Team B: </span> {{$register->team_b}}</p>
        <p><span class="badge badge-warning">Results: </span> {{$register->result}}</p>
        <p><span class="badge badge-warning">Quantity Goal A: </span> {{$register->scoreboard_a}}</p>
        <p><span class="badge badge-warning">Quantity Goal B: </span> {{$register->scoreboard_b}}</p>
        <p><span class="badge badge-warning">Date: </span> {{$register->date}}</p>
        
        @if ($delete)
            @form(['action'=>route($routeName.'.destroy',$register->id),'method'=>'DELETE'])
            <button class="btn btn-danger btn-lg">Delete</button> 
            @endform
        @endif

                  
    @endpage
@endsection
