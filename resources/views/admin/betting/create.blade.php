@extends('layouts.app')

@section('content')

    @page(['col'=>12, 'name'=>'Create betting'])


        @alert(['msg'=>session('msg'),'status'=>session('status')])
        @endalert
        
        @form(['action'=>route('betting.store'),'method'=>'POST'])
            @include('admin.betting.form')
            <button class="btn btn-primary btn-lg">Create</button> 
            <a href="{{route('betting.index')}}" class="btn btn-secondary btn-lg float-right">Back</a> 
        @endform
    
                  
                       
    @endpage
@endsection
