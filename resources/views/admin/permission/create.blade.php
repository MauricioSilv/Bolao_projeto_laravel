@extends('layouts.app')

@section('content')

    @page(['col'=>12, 'name'=>'Create permission'])


        @alert(['msg'=>session('msg'),'status'=>session('status')])
        @endalert
        
        @form(['action'=>route('permission.store'),'method'=>'POST'])
            @include('admin.permission.form')
            <button class="btn btn-primary btn-lg">Create</button> 
            <a href="{{route('permission.index')}}" class="btn btn-secondary btn-lg float-right">Back</a> 
        @endform
    
                  
                       
    @endpage
@endsection
