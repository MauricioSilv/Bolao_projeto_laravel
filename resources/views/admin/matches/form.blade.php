
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
        <label for="round_id">Rounds</label>
        <select class="form-control{{ $errors->has('round_id') ? ' is-invalid' : '' }}" name="round_id">
            @foreach ($listRel as $key => $value)
                @php
                    $select = '';
                        if(old('round_id') ?? false){
                            if(old('round_id') == $value->id){
                                $select = "selected";
                            }
                        }else{
                            if($round_id ?? false){
                                if($round_id == $value->id){
                                    $select = "selected";
                                }
                            }   
                        }
                @endphp
                 <option {{$select}} value="{{$value->id}}">{{$value->title}}</option>
            @endforeach
        </select>

        @if ($errors->has('round_id'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('round_id') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group col-6">
        <label for="stadium">Stadium</label>
        <input type="text" class="form-control{{ $errors->has('stadium') ? ' is-invalid' : '' }}" name="stadium" value="{{ old('stadium') ?? ($register->stadium ?? '') }}" autofocus>
        
        @if ($errors->has('stadium'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('stadium') }}</strong>
            </span>
        @endif
    </div>

     <div class="form-group col-6">
        <label for="result">Result | (A - Time A, B - Time B, E - Empate)</label>
        <select class="form-control{{ $errors->has('result') ? ' is-invalid' : '' }}" name="result">
            @php 
            $listRel = ['A','B','E'];
            @endphp
            @foreach ($listRel as $item => $value)
                @php
                    $select = '';
                        if(old('result') ?? false){
                            if(old('result') == $value->result){
                                $select = "selected";
                            }
                        }else{
                            if($register->result ?? false){
                                if($register->result == $value){
                                    $select = "selected";
                                }
                            }else{
                                if($value === 'E')
                                {
                                    $select = "selected";
                                }
                            }   
                        }
                @endphp
                 <option {{$select}} value="{{$value}}">{{$value}}</option>
            @endforeach
        </select>

        @if ($errors->has('round_id'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('round_id') }}</strong>
            </span>
        @endif
    </div>
   

    <div class="form-group col-6">
        <label for="team_a">Team A</label>
        <input type="text" class="form-control{{ $errors->has('team_a') ? ' is-invalid' : '' }}" name="team_a" value="{{ old('team_a') ?? ($register->team_a ?? '') }}" autofocus>
        
        @if ($errors->has('team_a'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('team_a') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-6">
        <label for="team_b">Team B</label>
        <input type="text" class="form-control{{ $errors->has('team_b') ? ' is-invalid' : '' }}" name="team_b" value="{{ old('team_b') ?? ($register->team_b ?? '') }}" autofocus>
        
        @if ($errors->has('team_b'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('team_b') }}</strong>
            </span>
        @endif
    </div>
    
     <div class="form-group col-6">
        <label for="scoreboard_a">Scoreboard A</label>
        <input type="text" class="form-control{{ $errors->has('scoreboard_a') ? ' is-invalid' : '' }}" name="scoreboard_a" value="{{ old('scoreboard_a') ?? ($register->scoreboard_a ?? '0') }}" autofocus>
        
        @if ($errors->has('scoreboard_a'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('scoreboard_a') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-6">
        <label for="scoreboard_b">Scoreboard B</label>
        <input type="text" class="form-control{{ $errors->has('scoreboard_b') ? ' is-invalid' : '' }}" name="scoreboard_b" value="{{ old('scoreboard_b') ?? ($register->scoreboard_b ?? '0') }}" autofocus>
        
        @if ($errors->has('scoreboard_b'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('scoreboard_b') }}</strong>
            </span>
        @endif
    </div>




    <div class="form-group col-6">
        <label for="date">Date</label>
    <input type="datetime" placeholder="{{date('Y-m-d H:i')}}" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" name="date" value="{{ old('date') ?? ($register->date ?? '') }}" autofocus>
        
        @if ($errors->has('date'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('date') }}</strong>
            </span>
        @endif
    </div>
   
</div>