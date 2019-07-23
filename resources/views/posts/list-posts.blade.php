@extends('app')

@section('title')
My Sample page
@endsection

@section('content')
<h2>Posts</h2>
<div class="table-responsive">
<table class="table table-striped table-sm">
    <thead>
    <tr>
        <th>#</th>
        <th>Title</th>
        <th>Body</th>
    </tr>
    </thead>
    <tbody>
    @foreach($cursor as $document)
    <tr>
        <td>{{ $document['_id'] }}</td>
        <td>{{ $document['title'] }}</td>
        <td>{{ $document['body'] }}</td>
    </tr>
    @endforeach
    </tbody>
</table>
</div>
@endsection