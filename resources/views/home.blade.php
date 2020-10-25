@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
                <h2>{{ __('Blog Posts') }}</h2>
                <hr>
                    @foreach ($blogs as $blog)
                    <div class="col-md-12 mt-2">
                        <div class="card">
                            <div class="card-header">{{$blog->title}}</div>
                            <div class="card-body">
                                <p>{{$blog->description}}</p>
                            </div>
                            <div class="card-footer">
                                <small class="pull-right">
                                    @if($blog->user->avatar)
                                    <img src="{{ asset('storage/'.$blog->user->avatar) }}" alt="" class="avatar"  style="width:20px; height:20px;">
                                    @endif
                                    {{$blog->user->name}} at {{$blog->created_at->format('m-d-Y')}}
                                </small>
                            </div>
                        </div>
                    </div>
                        @endforeach
                        @if($blogs->isEmpty())
                        <div class="card">
                            <div class="card-body">
                                <p>
                                    There is no posts found at the moment.<a href="{{ route('blog.create') }}"> create post</a>
                                </p>
                            </div>
                        </div>
                        @endif
                </div>
    </div>
</div>
@endsection
