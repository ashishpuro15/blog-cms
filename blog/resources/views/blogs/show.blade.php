@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <div class="card mt-3">
                <div class="card-header d-flex">
                    <div class="col-md-11 d-flex align-items-center">Blog Post</div>
                    <div class="col-md-1"><a href="{{url('/home')}}" class="btn btn-primary">Back</a></div>
                </div>
                <div class="card-body">
                        <label for="Title">Title</label>
                        <h1>{{$post->title}}</h1>
                        <label for="Content">Content</label>
                        <h5>{{$post->content}}</h5>
                        <label for="Author">Author</label>
                        <h6>{{$post->author}}</h6>
                        <label for="Publication Date">Publication Date</label>
                        <h6>{{date_format(date_create($post->published_date), 'Y-m-d')}}</h6>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection