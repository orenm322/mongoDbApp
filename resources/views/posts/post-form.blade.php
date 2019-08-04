@extends('app')

@section('title')
{{ $title }}
@endsection

@section('content')

<h2>{{ $title }}</h2>
<form method="POST">
    @csrf
    
    @if (!empty($errors->all() ) )
       <div class="alert alert-danger" role="alert">
       @foreach ($errors->all() as $message)
        <div>{{ $message }}</div>
       @endforeach 
       </div>
    @endif
    
    <div class="form-group">
      <label for="title">Title:</label>
      <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="{{ isset($document['title']) ? $document['title'] : "" }}" required>
    </div>
    <div class="form-group">
      <label for="body">Body:</label>
      <textarea class="form-control" name="body" id="body" rows="3" placeholder="Body" required>{{ isset($document['body']) ? $document['body'] : "" }}</textarea>
    </div>

    <div class="form-group">
      <label for="category">Category:</label>
      @foreach ($categories as $category)
      <div class="form-check form-check-inline">
        <input class="form-check-input" 
              type="checkbox" 
              name="category[]" 
              id="opt{{$category}}" 
              value="{{$category}}"
              {{ isset($document['category']) && in_array($category, $document['category'] ) ? "checked" : "" }}
        />
        <label class="form-check-label" for="opt{{$category}}">{{$category}}</label>
      </div> 
      @endforeach
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-primary mb-2">Submit</button>
      <button type="reset" class="btn btn-primary mb-2">Reset</button>
    </div>
  </form>
@endsection