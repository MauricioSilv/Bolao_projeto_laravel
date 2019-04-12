
<!--Component alert --> 
@if ($msg)
<div class="alert alert-{{ $status }}" role="alert">
    {{ $msg }}
</div>
@endif