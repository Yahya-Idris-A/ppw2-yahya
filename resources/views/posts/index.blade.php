@extends('layouts.base')

@section('content')
<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> {{ $title }} </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active">Projects</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body color_post">
                        @if (\Session::has('success'))
                        <div class="alert alert-success">
                            {!! \Session::get('success') !!}
                        </div>
                        @endif
                        <h1>Blog Posts</h1>
                        <a href="/posts/create">Create New Projects</a>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Gambar</th>
                                        <th>Nama Project</th>
                                        <th>Tanggal diupload</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 1;
                                    @endphp
                                    @if(count($posts)>0)
                                    @foreach ($posts as $post)
                                    <tr>
                                        <td>{{ $i++; }}</td>
                                        <td>
                                            <a href="{{asset("storage/posts_image/".$post->picture)}}"
                                                class="example-image-link" data-lightbox="example-2"
                                                data-title="{{ $post->picture }}">
                                                <img src="{{asset("storage/posts_image/".$post->picture)}}"
                                                    alt="image-1" class="card-img-top img-admin-data img-thumb"></a>
                                        </td>
                                        <td>{{$post->title}}</td>
                                        <td>{{$post->created_at}}</td>
                                        <td>{{ substr($post->description, 0, 20) }}</td>
                                        <td>
                                            <a href="/posts/{{$post->id}}" class="btn btn-outline-light">view</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="6" class="text-center">No products yet!!!</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        Halaman : {{ $posts->currentPage() }} <br>
                        Jumlah Data : {{ $posts->total() }} <br>
                        Data Per Halaman : {{ $posts->perPage() }} <br>
                        <div class="d-flex">
                            {{ $posts->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
