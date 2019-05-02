@extends('layouts.app')

@section('content')
@page(['col'=>8, 'name'=>'Painel'])

        @alert(['msg'=>session('msg'),'status'=>session('status')])
        @endalert
    
        <div class="row">
                @can('list-user')
                   <div style="cursor:pointer" onclick="window.location ='{{route('users.index')}}' " class="card text-white bg-primary m-3" style="max-width: 18rem;">
                       <div class="card-header">List of users</div>
                       <div class="card-body">
                           <p class="card-text">Create or edit</p>
                       </div>
                   </div>
                @endcan
                
             
               <div style="cursor:pointer" onclick="window.location ='{{route('permission.index')}}' " class="card text-white bg-danger m-3" style="max-width: 18rem;">
                   <div class="card-header">Permissions list</div>
                   <div class="card-body">
                   <p class="card-text">Create or edit</p>
                   </div>
               </div>

               <div style="cursor:pointer" onclick="window.location ='{{route('roles.index')}}' " class="card text-white bg-success m-3" style="max-width: 18rem;">
                   <div class="card-header">Roles list</div>
                   <div class="card-body">
                   <p class="card-text">Create or edit</p>
                   </div>
               </div>
             </div>        
                       
    @endpage
@endsection
