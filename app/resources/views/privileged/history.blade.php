@extends('layouts.app')
@section('content')
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">History</div>
<div class="panel-body">
<p>Welcome  {{ Auth::user()->name }} ,</p>
You can see this because you have the role of an {{ Auth::user()->roles->first()->name }}
</div>
</div>
</div>
</div>
</div>
@endsection