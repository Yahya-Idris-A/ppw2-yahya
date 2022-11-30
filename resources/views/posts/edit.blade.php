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
                    <li class="breadcrumb-item"><a href="/posts">Projects</a></li>
                    <li class="breadcrumb-item"><a href="/posts/{{ $posts->id }}">Detail project</a></li>
                    <li class="breadcrumb-item active">Edit project</li>
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
                        <h1>Edit Blog Post</h1>
                        {{-- @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                    @endif --}}
                    <form action="{{ route('posts.update', $posts->id) }}" method="post" enctype="multipart/form-data">
                        @method('PUT')
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control 
                                @error('title')
                                    is-invalid
                                @enderror" aria-describedby="emailHelp" name="title" value="{{ $posts->title }}">
                            @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control 
                                @error('description')
                                    is-invalid
                                @enderror" name="description" id="description"
                                rows="5">{{ $posts->description }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="input-file">Image File Input</label>
                            @if ($posts->picture)
                            <img src="{{ asset('storage/posts_image/' . $posts->picture) }}"
                                class="img-preview img-fluid mb-3 col-sm-5 d-block">
                            @else
                            <img class="img-preview img-fluid mb-3 col-sm-5">
                            @endif
                            <input type="file" class="form-control 
                                @error('picture')
                                    is-invalid
                                @enderror" id="input-file" name="picture" onchange="previewImage()">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button><br><br>
                        <a class="btn btn-primary" role="button" href="/posts/{{ $posts->id }}">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    function previewImage() {
        const image = document.querySelector('#input-file');
        const imgPreview = document.querySelector('.img-preview');
        imgPreview.style.display = 'block';
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);
        oFReader.onload = function (oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }

</script>
@endsection
