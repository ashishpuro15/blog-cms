@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">                
            <div class="card mt-3">
                <div class="card-header d-flex">
                    <div class="col-md-5"><a href="{{url('blog/create')}}" class="btn btn-primary">Create Blog</a></div>
                    <div class="col-md-7 d-flex align-items-center">Fill Form</div>
                </div>
                <div class="card-body">
                    @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Content</th>
                                <th scope="col">Author</th>
                                <th scope="col">Publication Date</th>
                                <th scope="col">Show</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach($posts as $post)
                                <tr>
                                <th scope="row">{{$post->id}}</th>
                                <td>{{$post->title}}</td>
                                <td>{{$post->content}}</td>
                                <td>{{$post->author}}</td>
                                <td>{{$post->publication_date}}</td>
                                <td><button class="btn btn-success"><a href="/blog/show/{{$post->id}}" class="text-white text-decoration-none">Show</a></button></td>
                                <td><button class="btn btn-primary"><a href="/blog/edit/{{$post->id}}" class="text-white text-decoration-none">Edit</a></button></td>
                                <td>
                                    <form action="/api/post/delete/{{$post->id}}" method="post">  
                                        @csrf  
                                        @method('DELETE')  
                                        <button class="btn btn-danger" onclick="return confirm('Are you sure?')" type="submit">Delete</button>  
                                    </form>  
                                </td>
                                </tr>
                                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
