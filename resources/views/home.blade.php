@extends('layouts.app')

@section('content')
@page(['col'=>12, 'name'=>'Painel'])

        @alert(['msg'=>session('msg'),'status'=>session('status')])
        @endalert
    

        <div id="portfolio">
            <div class="row">
                @can('list-user')
                    <div style="cursor:pointer" onclick="window.location ='{{route('users.index')}}' " class="col-md-4 col-sm-6 portfolio-item">
                      <a class="portfolio-link">
                        <div class="portfolio-hover">
                          <div class="portfolio-hover-content">
                            <i class="fa fa-users fa-3x"></i>
                          </div>
                        </div>
                        <img class="img-fluid" src="img/portfolio/05-thumbnail.jpg" alt="">
                      </a>
                      <div class="portfolio-caption">
                        <h4>List of users</h4>
                        <p class="text-muted">Create or edit</p>
                      </div>
                    </div>
                @endcan
                @can('acl')
                <div style="cursor:pointer" onclick="window.location ='{{route('permission.index')}}' " class="col-md-4 col-sm-6 portfolio-item">
                        <a class="portfolio-link">
                          <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                              <i class="fa fa-exclamation-triangle fa-3x"></i>
                            </div>
                          </div>
                          <img class="img-fluid" src="img/portfolio/03-thumbnail.jpg" alt="">
                        </a>
                        <div class="portfolio-caption">
                          <h4>Permissions list</h4>
                          <p class="text-muted">Create or edit</p>
                        </div>
                      </div>

                      <div style="cursor:pointer" onclick="window.location ='{{route('roles.index')}}' " class="col-md-4 col-sm-6 portfolio-item">
                            <a class="portfolio-link">
                              <div class="portfolio-hover">
                                <div class="portfolio-hover-content">
                                  <i class="fa fa-cog fa-3x"></i>
                                </div>
                              </div>
                              <img class="img-fluid" src="img/portfolio/02-thumbnail.jpg" alt="">
                            </a>
                            <div class="portfolio-caption">
                              <h4>Roles list</h4>
                              <p class="text-muted">Create or edit</p>
                            </div>
                      </div>
                   @endcan
                </div>
              </div>     
    @endpage
@endsection
