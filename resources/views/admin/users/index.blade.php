@extends('layouts.app')

@section('content')

    @page(['col'=>12, 'name'=>'List'])


                   @alert(['msg'=>session('msg'),'status'=>session('status')])
                   @endalert

                   @search(['search'=>$search])
                   @endsearch
               
                   @table(['modelAll'=>$modelAll])
                   @endtable
                   
                   @paginate(['search'=>$search, 'modelAll'=>$modelAll])
                   @endpaginate 
                       
    @endpage
@endsection
