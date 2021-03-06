<form class="form-inline" method="GET" action="{{route($routeName.'.index')}}">
    <div class="form-group mb-2">

        @can('create-user')
            <a href="{{route($routeName.'.create')}}">Adicionar</a>
        @endcan

    </div>
    <div class="form-group mx-sm-3 mb-2">
    <input type="search" name="search" class="form-control" value="{{$search}}"/>
    </div>
    <button type="submit" class="btn btn-primary mb-2">Buscar</button>
    <a class="btn btn-outline-secondary mb-2 ml-1" href="{{route($routeName.'.index')}}" role="button">Limpar</a>

</form>