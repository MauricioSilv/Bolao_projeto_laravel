@extends('layouts.app')

@section('content')

    @page(['col'=>12])


                   @alert(['msg'=>session('msg'),'status'=>session('status')])
                   @endalert
                   
                   @breadcrumb()
                   @endbreadcrumb

                   @search(['search'=>$search])
                   @endsearch
               
                   @table(['modelAll'=>$modelAll])
                   @endtable
                   
                   @paginate(['search'=>$search, 'modelAll'=>$modelAll])
                   @endpaginate 
                       
    @endpage
@endsection
