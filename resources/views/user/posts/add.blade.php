@extends('layouts.app')

@section('title', 'Add Post')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Post</h1>
        <a href="{{route('posts.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add New Post</h6>
        </div>
        <form method="POST" action="{{route('posts.store')}}" accept-charset="utf-8"
        enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>Title</label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('title') is-invalid @enderror"
                            id="exampleFirstName"
                            placeholder="Title"
                            name="title"
                            value="{{ old('title') }}">

                        @error('title')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>Description</label>
                        <textarea
                            type="text"
                            class="form-control form-control-user @error('desc') is-invalid @enderror"
                            id="exampleEmail"
                            placeholder="Description"
                            name="desc">{{ old('desc') }}</textarea>

                        @error('desc')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>Photo</label>
                        <input type="file" name="postpic" class="form-control form-control-user @error('postpic') is-invalid @enderror" class="form-control" id="postpic" value="{{ old('postpic') }}">
                        @error('postpic')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success btn-user float-right mb-3">Save</button>
                <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('posts.index') }}">Cancel</a>
            </div>
        </form>
    </div>

</div>


@endsection
