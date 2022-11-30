@extends('layouts.base')

@section('content')
<div class="col-md-8 articles" id="site-content">
    <article class="posts">
        @if (\Session::has('success'))
        <div class="alert alert-success">
            {!! \Session::get('success') !!}
        </div>
        @endif
        <h1>Projects</h1>
        <a href="/posts/create">Create New Projects</a>
        @if(count($posts)>0)
        @foreach ($posts as $post)
        <div class="well">
            <h3><a href="/posts/{{$post->id}}">
                    {{$post->title}}</a></h3>
            <small>
                Tanggal: {{$post->created_at}}
            </small>
        </div>
        @endforeach
        @else
        <h3>Tidak ada data.</h3>
        @endif <br>
        Halaman : {{ $posts->currentPage() }} <br>
        Jumlah Data : {{ $posts->total() }} <br>
        Data Per Halaman : {{ $posts->perPage() }} <br>
        <div class="d-flex">
            {{ $posts->links() }}
        </div>
    </article>
</div>
@endsection
