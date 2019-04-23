
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
        <label for="email">E-mail</label>
        <input type="mail" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') ?? ($register->email ?? '') }}" required autofocus>
        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group col-6">
        <label for="password">Password</label>
        <input type="password" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="password" id="">
        @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group col-6">
        <label for="password_confirmation">Password Confirmation</label>
        <input type="password" class="form-control" name="password_confirmation" id="">
    </div>

    <div class="form-group col-6">
        <label for="roles">Roles</label>
        <select multiple class="form-control" name="roles[]">
          @foreach ($roles as $role)
            @php
                $select = "";
                
                if(old('roles') !== null)
                {
                    foreach (old('roles') as $key => $value) 
                    {
                        if($value == $role->id)
                        {
                            $select = "selected";
                        }
                    }
                }else{
                    if($register ?? false)
                    {
                        foreach ($register->roles as $key => $rol) 
                    {
                        if($rol->id == $role->id)
                        {
                            $select = "selected";
                        }
                    }
                    }
                }
                
            @endphp


            <option {{$select}} value="{{$role->id}}">
                {{$role->name}}    
            </option> 
          @endforeach
        </select>

    </div>

</div>