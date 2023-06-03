@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <div class="card mt-3">
                <div class="card-header d-flex">
                    <div class="col-md-11 d-flex align-items-center">Add Blog</div>
                    <div class="col-md-1"><a href="{{url('/home')}}" class="btn btn-primary">Back</a></div>
                </div>
                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{session('status')}}
                        </div>
                    @endif
                    <form action="{{ url('/api/post/create') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <label for="Title">Title</label>
                        <input type="text" name="title" class="form-control mb-2">
                        <label for="Content">Content</label>
                        <textarea name="content" id="" cols="10" rows="5" class="form-control mb-2"></textarea>
                        <label for="Author">Author</label>
                        <input type="text" name="author" class="form-control mb-2">
                        <label for="Publication Date">Publication Date</label>
                        <input type="date" name="publication_date" class="form-control mb-2">
                        <input type="submit" value="Submit" name="submit" class="btn btn-primary mt-3">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
