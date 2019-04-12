
@php
    
    $method_input = "";
    if($method === "POST")
    {

    }elseif ($method === "PUT") 
    {
        $method = "POST";
        $method_input = method_field('PUT');
    }elseif($method === "DELETE"){
        $method = "POST";
        $method_input = method_field('DELETE');
    }else{
        $method = "GET";
    }
    

@endphp


<form method="{{$method}}" action="{{$action}}">
    @csrf
    {{$method_input}}
    {{$slot}}



</form>