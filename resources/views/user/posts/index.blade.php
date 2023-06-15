@extends('layouts.app')

@section('title', 'Users List')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Posts</h1>
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ route('posts.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Add New Post
                    </a>
                </div>

            </div>

        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Posts</h6>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Desc</th>
                                <th>Photo</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{ $post->name }}</td>
                                    <td>{{ $post->desc }}</td>
                                    <td><img src="{{ asset('posts/image/') }}/{{ $post->img }}" width="150" height="150"/></td>
                                    <td style="display: flex">
                                        <a href="{{ route('posts.edit', ['post' => $post->id]) }}"
                                            class="btn btn-primary m-2">
                                            <i class="fa fa-pen">Edit</i>
                                        </a>
                                        <a class="btn btn-danger"
                    onclick="event.preventDefault(); document.getElementById('user-delete-form').submit();">
                    <i class="fas fa-trash">Delete</i>
                </a>
                <form id="user-delete-form" method="POST" action="{{ route('posts.destroy', ['post' => $post->id]) }}">
                    @csrf
                    @method('DELETE')
                </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $posts->links() }}
                </div>
            </div>
        </div>

    </div>

    {{-- @include('users.delete-modal') --}}

@endsection

@section('scripts')

@endsection
