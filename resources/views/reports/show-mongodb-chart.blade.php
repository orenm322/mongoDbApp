@extends('app')

@section('title')
Reports
@endsection

@section('content')

<div class="embed-responsive embed-responsive-16by9">
    <iframe class="embed-responsive-item" width="640" height="480" src="{{ $url }}" allowfullscreen></iframe>
</div>

@endsection