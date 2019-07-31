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
        <th>Created Date</th>
        <th>Update Date</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
    <tr>
        <td>{{ $user['title'] }}</td>
        <td>{{ \App\Classes\MongoDBHelper::getLocalDatetime($user['created_date']) }}</td>
        <td>{{ \App\Classes\MongoDBHelper::getLocalDatetime($user['updated_date']) }}</td>
        <td>
            <a href="/posts/detail/{{$user['_id']}}"><button type="button" class="btn btn-primary" role="button">View Detail</button></a>
            <a href="/posts/delete/{{$user['_id']}}"><button type="button" class="btn btn-danger" role="button">Delete</button></a>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
</div>

{{ $users->links() }}

<div class="ml-1">
    <a href="/posts/add" ><button type="button" class="btn btn-dark">Add</button></a>
</div>


@endsection