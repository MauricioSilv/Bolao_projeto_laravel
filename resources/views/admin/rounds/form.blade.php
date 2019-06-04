
<div class="row">
    <div class="form-group col-6">
        <label for="title">Title</label>
        <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') ?? ($register->title ?? '') }}" autofocus>
        
        @if ($errors->has('title'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group col-6">
        <label for="betting_id">Betting</label>
        <select class="form-control{{ $errors->has('betting_id') ? ' is-invalid' : '' }}" name="betting_id">
            @foreach ($listRel as $item)
                @php
                    $select = '';
                        if(old('betting_id') ?? false){
                            if(old('betting_id') == $item->id){
                                $select = "selected";
                            }
                        }else{
                            if($register_id ?? false){
                                if($register_id == $item->id){
                                    $select = "selected";
                                }
                            }   
                        }
                @endphp
                 <option {{$select}} value="{{$item->id}}">{{$item->title}}</option>
            @endforeach
        </select>

        @if ($errors->has('betting_id'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('betting_id') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group col-6">
        <label for="date_start">Date start</label>
    <input type="datetime" placeholder="{{date('Y-m-d H:i')}}" class="form-control{{ $errors->has('date_start') ? ' is-invalid' : '' }}" name="date_start" value="{{ old('date_start') ?? ($register->date_start ?? '') }}" autofocus>
        
        @if ($errors->has('date_start'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('date_start') }}</strong>
            </span>
        @endif
    </div>
    
    <div class="form-group col-6">
        <label for="date_end">Date end</label>
    <input type="datetime" placeholder="{{date('Y-m-d H:i')}}" class="form-control{{ $errors->has('date_end') ? ' is-invalid' : '' }}" name="date_end" value="{{ old('date_end') ?? ($register->date_end ?? '') }}" autofocus>
        
        @if ($errors->has('date_end'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('date_end') }}</strong>
            </span>
        @endif
    </div>
   
</div>