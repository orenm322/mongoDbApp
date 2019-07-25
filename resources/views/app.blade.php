<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/dashboard.css')}}" rel="stylesheet">

    <title>
      @yield('title')
    </title>
    
  </head>
  <body>

  <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-12 mr-0" href="/">MongoDB Sample App</a>
</nav>

<div class="container-fluid">
  <div class="row">
    @include('sidebar')

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

      @yield('content')
      
    </main>
  </div>
</div>

    <script src="{{asset('js/app.js')}})"></script>
    <script src="{{asset('js/dashboard.js')}}"></script>
</body>
</html>