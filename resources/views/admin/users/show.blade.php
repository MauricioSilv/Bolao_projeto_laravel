@extends('layouts.app')

@section('content')

    @page(['col'=>12, 'name'=>'Info users'])

        @alert(['msg'=>session('msg'),'status'=>session('status')])
        @endalert
        <p>Name: {{$register->name}}</p>
        <p>E-mail: {{$register->email}}</p>
        
        @if ($delete)
            @form(['action'=>route('users.destroy',$register->id),'method'=>'DELETE'])
            <button class="btn btn-danger btn-lg">Delete</button> 
            @endform
        @endif

                  
    @endpage
@endsection
