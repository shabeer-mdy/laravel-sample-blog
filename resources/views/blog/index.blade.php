@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('My Blogs') }}</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($blogs as $key => $blog)
                            <tr>
                                <th scope="col">{{ $key+1 }}</th>
                                <th scope="col">{{ $blog->title }}</th>
                                <th scope="col">
                                    <a href="{{ route('blog.edit', $blog) }}">Edit</a>
                                    <a href="{{ route('blog.delete', $blog) }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('delete-form').submit();">
                                        {{ __('Delete') }}
                                    </a>

                                    <form id="delete-form" action="{{ route('blog.delete', $blog) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('delete')
                                    </form>
                                    {{-- <a href="{{ route('blog.delete', $blog) }}"></a> --}}
                                </th>
                            </tr>
                            @endforeach
                            @if($blogs->isEmpty())
                            <tr>
                                <th colspan="3" align="center">
                                    No blog post found. <a href="{{ route('blog.create') }}">Create Blog</a>
                                </th>
                            </tr>
                            @endif
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
