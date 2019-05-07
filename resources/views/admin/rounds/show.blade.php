@extends('layouts.app')

@section('content')

    @page(['col'=>12, 'name'=>'Info users'])

        @alert(['msg'=>session('msg'),'status'=>session('status')])
        @endalert
        <p><span class="badge badge-warning">Title: </span> {{$register->title}}</p>
        <p><span class="badge badge-warning">Betting: </span> {{$register->betting_title}}</p>
        <p><span class="badge badge-warning">Date start: </span> {{$register->date_start_site}}</p>
        <p><span class="badge badge-warning">Date end: </span> {{$register->date_end_site}}</p>
        
        @if ($delete)
            @form(['action'=>route($routeName.'.destroy',$register->id),'method'=>'DELETE'])
            <button class="btn btn-danger btn-lg">Delete</button> 
            @endform
        @endif

                  
    @endpage
@endsection
