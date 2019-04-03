@extends('layouts.app')

@section('content')

    @page(['col'=>12, 'name'=>'Edit Roles'])


        @alert(['msg'=>session('msg'),'status'=>session('status')])
        @endalert
        
        @form(['action'=>route($routeName.'.update',$register->id),'method'=>'PUT'])
            @include('admin.'.$routeName.'.form')
            <button class="btn btn-primary btn-lg">Update</button>
            <a href="{{route($routeName.'.index')}}" class="btn btn-secondary btn-lg float-right">Back</a> 
        @endform
    
                  
                       
    @endpage
@endsection
