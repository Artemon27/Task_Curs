@extends('app')

@section('content')

Курс доллара:
@if ($usd_curs_old<$usd_curs)
<div class="green">&#9650;
@elseif ($usd_curs_old>$usd_curs) 
<div class="red">&#9660;
@else
<div>
@endif
{{$usd_curs}}</div><br>

Курс Евро:
@if ($eur_curs_old<$eur_curs)
<div class="green">&#9650;
@elseif ($eur_curs_old>$eur_curs) 
<div class="red">&#9660;
@else
<div>
@endif
{{$eur_curs}}</div>

@stop