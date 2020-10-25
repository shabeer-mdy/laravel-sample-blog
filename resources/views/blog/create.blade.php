@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('My Blogs') }}</div>
                <div class="card-body">
                    @if(!isset($blog))
                    <form role="form" action="{{  route('blog.create') }}" method="POST">
                    @else
                        <form role="form" action="{{  route('blog.edit', $blog) }}" method="POST">
                            @method('put')
                    @endif
                        @csrf
                        <div class="form-group">
                          <label for="blog-title">Title <em>*</em></label>
                          <input type="text" name="title" class="form-control" id="blog-title" aria-describedby="titleHelp" placeholder="Enter blog title" value="{{ $blog->title ?? old('title') }}">
                          @if($errors->has('title'))
                            <span class="text-danger">{{ $errors->first('title') }}</span>
                           @endif
                        </div>
                        <div class="form-group">
                          <label for="blogDescription1">Description</label>
                          <textarea type="Description" name="description" class="form-control" id="blogDescription1" aria-describedby="descriptionHelp" placeholder="Description" row=10>{{ $blog->description ?? old('description') }}</textarea>
                          @if($errors->has('description'))
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                           @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{route('blogs')}}" class="btn btn-warning">Cancel</a>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
