@extends('layouts.app')

@section('content')

    @page(['col'=>12, 'name'=>'Create users'])


        @alert(['msg'=>session('msg'),'status'=>session('status')])
        @endalert
        
        @form(['action'=>route($routeName.'.store'),'method'=>'POST'])
            @include('admin.'.$routeName.'.form')
            <button class="btn btn-primary btn-lg">Create</button> 
            <a href="{{route($routeName.'.index')}}" class="btn btn-secondary btn-lg float-right">Back</a> 
        @endform
    
                  
                       
    @endpage
@endsection
