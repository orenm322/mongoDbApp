@extends('app')

@section('title')
Posts List
@endsection

@section('content')

<h2>Posts</h2>

@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        {{$errors->first()}}
    </div>
@endif

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
            <a href="/posts/detail/{{$document['_id']}}"><button type="button" class="btn btn-primary" role="button">View Detail</button></a>
            <a href="/posts/delete/{{$document['_id']}}"><button type="button" class="btn btn-danger" role="button">Delete</button></a>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
</div>

<div class="ml-1">
    <a href="/posts/add" ><button type="button" class="btn btn-dark">Add</button></a>
</div>


@endsection