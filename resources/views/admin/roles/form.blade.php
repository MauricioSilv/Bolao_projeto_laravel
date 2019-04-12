
<div class="row">
    <div class="form-group col-6">
        <label for="name">Name</label>
        <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') ?? ($register->name ?? '') }}" required autofocus>
        
        @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group col-6">
        <label for="description">Description</label>
        <input type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('description') ?? ($register->description ?? '') }}" required autofocus>
        
        @if ($errors->has('description'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-6">
        <label for="permissions">Permissions</label>
        <select class="form-control" multiple name="permissions[]">
          @foreach ($permissions as $permission)
            <option value="{{$permission->id}}">
                {{$permission->name}}    
            </option> 
          @endforeach
        </select>

    </div>
    
   
</div>