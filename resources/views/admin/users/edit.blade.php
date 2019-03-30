@extends('layouts.app')

@section('content')

    @page(['col'=>12, 'name'=>'Edit users'])


        @alert(['msg'=>session('msg'),'status'=>session('status')])
        @endalert
        
        @form(['action'=>route('users.update',$register->id),'method'=>'PUT'])
            @include('admin.users.form')
            <button class="btn btn-primary btn-lg">Update</button>
            <a href="{{route('users.index')}}" class="btn btn-secondary btn-lg float-right">Back</a> 
        @endform
    
                  
                       
    @endpage
@endsection
