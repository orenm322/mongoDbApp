@extends('app')

@section('title')
Reports
@endsection

@section('content')

<h2>Sample Graph</h2>

<div class="embed-responsive embed-responsive-16by9">
    {{-- <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0" allowfullscreen></iframe> --}}
    {{-- <iframe class="embed-responsive-item" src="https://charts.mongodb.com/charts-project-0-ntzrn/embed/charts?id=bd57a1ff-7fa7-4385-86aa-de4a56c8cf04&tenant=a22fc6fe-6a07-4ceb-8e77-3238ed241751" allowfullscreen></iframe> --}}

    <iframe class="embed-responsive-item" width="640" height="480" src="{{ $url }}" allowfullscreen></iframe>

</div>

@endsection