<form class="form-inline" method="GET" action="{{route('users.index')}}">
    <div class="form-group mb-2">
    <a href="{{route('users.create')}}">Adicionar</a>
    </div>
    <div class="form-group mx-sm-3 mb-2">
    <input type="search" name="search" class="form-control" value="{{$search}}"/>
    </div>
    <button type="submit" class="btn btn-primary mb-2">Buscar</button>
    <a class="btn btn-outline-secondary mb-2 ml-1" href="{{route('users.index')}}" role="button">Limpar</a>

</form>