@extends('layouts.base')

@section('content')
<style type="text/css">
    .pagination li {
        float: left;
        list-style-type: none;
        margin: 5px;
    }

</style>
<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ $menu }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active">{{ $menu }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card card-success">
                    <div class="card-header">
                        <h4 class="card-title">{{ $menu }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if(count($galleries)>0)
                            @foreach($galleries as $gallery)
                            <div class="col-sm-2">
                                <div>
                                    <a href="{{ asset('storage/posts_image/'.$gallery->picture) }}"
                                        class="example-image-link" data-lightbox="example-2"
                                        data-title="{{ $gallery->title }}">
                                        <img src="{{ asset('storage/posts_image/'.$gallery->picture) }}" alt="image-1"
                                            class="example-image img-fluid mb-2"></a>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <h3>Data Not Found</h3>
                            @endif
                            <div class="d-flex">
                                {{ $galleries->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
