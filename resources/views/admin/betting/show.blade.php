@extends('layouts.app')

@section('content')

    @page(['col'=>12, 'name'=>'Info betting'])

        @alert(['msg'=>session('msg'),'status'=>session('status')])
        @endalert
        <p><span class="badge badge-success">Title: </span> {{$register->title}}</p>
        <p><span class="badge badge-success">Current round: </span> {{$register->current_round}}</p>
        <p><span class="badge badge-success">Value result </span> {{$register->value_result}}</p>
        <p><span class="badge badge-success">Extra value: </span> {{$register->extra_value}}</p>
        <p><span class="badge badge-success">Value fee: </span> {{$register->value_fee}}</p>
        
        @if ($delete)
            @form(['action'=>route($routeName.'.destroy',$register->id),'method'=>'DELETE'])
            <button class="btn btn-danger btn-lg">Delete</button> 
            @endform
        @endif

                  
    @endpage
@endsection
