@extends('layouts.app')

@section('content')

    @page(['col'=>12, 'name'=>'Info users'])

        @alert(['msg'=>session('msg'),'status'=>session('status')])
        @endalert
        <p><span class="badge badge-success">Name: </span> {{$register->name}}</p>
        <p><span class="badge badge-success">Description: </span> {{$register->description}}</p>
        
        @if ($delete)
            @form(['action'=>route($routeName.'.destroy',$register->id),'method'=>'DELETE'])
            <button class="btn btn-danger btn-lg">Delete</button> 
            @endform
        @endif

                  
    @endpage
@endsection
