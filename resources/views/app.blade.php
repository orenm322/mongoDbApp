<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    {{-- <link href="{{asset('css/dashboard.css')}}" rel="stylesheet"> --}}

    <title>
      @yield('title')
    </title>
    
  </head>
  <body>


<nav class="navbar navbar-expand-md navbar-dark bg-dark">
  <a class="navbar-brand" href="/">MongoDB Sample App</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/posts">Posts <span class="sr-only">(current)</span></a>
      </li>
    </ul>
  </div>
</nav>

<div class="container-fluid">
  <div class="mt-1">
    @yield('content')
  </div>
</div>

    <script src="{{asset('js/app.js')}}"></script>
    {{-- <script src="{{asset('js/dashboard.js')}}"></script> --}}
</body>
</html>