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
        {{-- @include('common.alert') --}}

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
                                <th width="20%">Name</th>
                                <th width="25%">Desc</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{ $post->name }}</td>
                                    <td>{{ $post->desc }}</td>
                                    <td style="display: flex">
                                        <a href="{{ route('posts.edit', ['post' => $post->id]) }}"
                                            class="btn btn-primary m-2">
                                            <i class="fa fa-pen"></i>
                                        </a>
                                        <a class="btn btn-danger m-2" href="#" data-toggle="modal" data-target="#deleteModal">
                                            <i class="fas fa-trash"></i>
                                        </a>
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
