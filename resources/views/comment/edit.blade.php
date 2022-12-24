@extends('layouts.app')

@section('title','EDIT PAGE')

@section('content')

    <div class="container">
        <a href="{{route('products.index')}}">{{ __('messages.index') }}</a>
        <div class="row">
            <div class="col-sm-12">
                <form action="{{route('comment.update', $comment->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="contentInput">{{ __('messages.content') }}:</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" id="contentInput" rows="3" name="content">{{$comment->content}}</textarea>
                        @error('content')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <button class="btn btn-outline-primary" type="submit">{{ __('messages.save') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection

