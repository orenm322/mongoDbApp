@extends('app')

@section('title')
Posts List
@endsection

@section('content')

<h2>Posts</h2>
<div class="table-responsive">
<table class="table table-striped table-sm">
    <thead>
    <tr>
        <th>Title</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($cursor as $document)
    <tr>
        <td>{{ $document['title'] }}</td>
        <td>
            <a href="/posts/detail/{{$document['_id']}}" type="button" class="btn btn-primary" role="button">View Detail</a>
            <a href="/posts/delete/{{$document['_id']}}" type="button" class="btn btn-danger" role="button">Delete</a>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
</div>

<div class="row">
    <a href="/posts/add" type="button" class="btn btn-dark">Add</a>
</div>


@endsection