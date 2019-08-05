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
        <th>Author</th>
        @if(Auth::check())
        <th>Actions</th>
        @endif
    </tr>
    </thead>
    <tbody>
    @foreach($posts as $post)
    <tr>
        <td>{{ $post['title'] }}</td>
        <td>{{ \App\Classes\MongoDBHelper::getLocalDatetime($post['created_date']) }}</td>
        <td>{{ \App\Classes\MongoDBHelper::getLocalDatetime($post['updated_date']) }}</td>
    <td>{{ $post['author_detail'][0]['name'] }}</td>
        @if(Auth::check() )
        <td>
            @if ((string) $post['author_detail'][0]['_id'] === Auth::user()->_id )
            <a href="/posts/detail/{{$post['_id']}}"><button type="button" class="btn btn-primary" role="button">View Detail</button></a>
            <a href="/posts/delete/{{$post['_id']}}"><button type="button" class="btn btn-danger" role="button">Delete</button></a> 
            @endif 
        </td>
        @endif
    </tr>
    @endforeach
    </tbody>
</table>
</div>

{{-- {{ $post->links() }} --}}

<div class="ml-1">
    <a href="/posts/add" ><button type="button" class="btn btn-dark">Add</button></a>
</div>


@endsection