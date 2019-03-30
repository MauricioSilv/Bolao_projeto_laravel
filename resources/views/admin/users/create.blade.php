@extends('layouts.app')

@section('content')

    @page(['col'=>12, 'name'=>'Create users'])


        @alert(['msg'=>session('msg'),'status'=>session('status')])
        @endalert
        
        @form(['action'=>route('users.store'),'method'=>'POST'])
            @include('admin.users.form')
            <button class="btn btn-primary btn-lg">Create</button> 
            <a href="{{route('users.index')}}" class="btn btn-secondary btn-lg float-right">Back</a> 
        @endform
    
                  
                       
    @endpage
@endsection
