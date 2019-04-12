@extends('layouts.app')

@section('content')

    @page(['col'=>12, 'name'=>'List'])


                   @alert(['msg'=>session('msg'),'status'=>session('status')])
                   @endalert

                   @search(['search'=>$search, 'routeName'=>$routeName])
                   @endsearch
               
                   @table(['list'=>$list, 'columnList'=>$columnList, 'routeName'=>$routeName])
                   @endtable
                   
                   @paginate(['search'=>$search, 'list'=>$list])
                   @endpaginate 
                       
    @endpage
@endsection
