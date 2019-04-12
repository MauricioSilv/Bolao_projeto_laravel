@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                  <div class="row">
                  <div style="cursor:pointer" onclick="window.location ='{{route('users.index')}}' " class="card text-white bg-primary m-3" style="max-width: 18rem;">
                        <div class="card-header">List of users</div>
                        <div class="card-body">
                          <p class="card-text">Create or edit</p>
                        </div>
                    </div>
                  
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
              </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
