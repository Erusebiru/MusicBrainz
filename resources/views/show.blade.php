
@extends('welcome')

@section('content')


<div class="container" style="display:flex;justify-content:center;width:100%;align-items:center;margin:0;">
    <h1>{{$title}}</h1>
    <div id="table"></div>
</div>

<script>
    
    var dades = {!! json_encode($dades, JSON_HEX_TAG) !!} ;
    CreateTable("#table",dades,undefined)
</script>

@stop