@extends('layouts.app')

@section('title','PRODUCT PAGE')

@section('content')
    <div class="container">
        <a class="btn btn-outline-primary" href="{{ route('products.index') }}">{{ __('messages.index') }}</a>
                <div class="card" >
                    <div class="card-header">
                        <h5 class="card-title">{{$product->title }}</h5>
                        <img src="{{asset($product->img)}}" width="150px">
                       </div>
                    <div class="card-body">
                        <p class="card-text">{{$product->content}}</p>
                        <small class="text-muted">{{$product->price}} {{ __('messages.tenge') }}</small><hr>
                        <a href="{{route('products.edit',$product->id)}}" class="btn btn-outline-primary">{{ __('messages.edit') }}</a>
                        @auth()
                            <form action="{{route('products.addcart', $product->id)}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="sizeInput">{{ __('messages.size') }}</label>
                                    <select class="form-select" name="size">
                                        @foreach ($sizes as $size)
                                            @isset($productsSize->pivot->size)
                                                <option value="{{ $size }}"
                                                    {{ $productsSize->pivot->size == $size ? 'selected' : '' }}>
                                                    {{ $size }}
                                                </option>
                                            @else
                                                <option value="{{ $size }}">
                                                    {{ $size }}
                                                </option>
                                            @endisset
                                        @endforeach
                                    </select>
                                </div><br>
                                <div class="form">
                                    <label for="numberInput">{{ __('messages.count') }}</label>
                                    <input type="number" name="number" placeholder="0">
                                </div>
                                <button class="btn btn-outline-secondary">{{ __('messages.save') }}</button><br>
                            </form>
                        @endauth
                    </div>
                    <div class="card-footer">
                        @auth()
                            <form action="{{route('products.review', $product->id)}}" method="post">
                                @csrf
                                <label for="contentInput" >{{ __('messages.review') }}</label><br>
                                <select name="review">
                                    @for($i=0; $i<=5; $i++)
                                        <option {{$myReview==$i ? 'selected' : ''}} value="{{$i}}">
                                            {{$i==0 ?  __('messages.no_review')  : $i}}
                                        </option>
                                    @endfor
                                </select>
                                <button class="btn btn-outline-secondary">{{ __('messages.save') }}</button>
                            </form>
                            <form action="{{route('products.unreview', $product->id)}}" method="post">
                                @csrf
                                <button class="btn btn-outline-danger">{{ __('messages.review_delete') }}</button>
                            </form>
                        @endauth<br>
                        <form action="{{route('comment.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="contentInput" >{{ __('messages.comment') }}</label><br>
                                <textarea class="form-control" id="contentInput" rows="3"  name="content"></textarea>
                                <input type="hidden" value="{{$product->id}}" name="product_id">
                                <br>
                                <div class="form-group mt-3">
                                    <button  class="btn btn-outline-secondary">{{ __('messages.save') }}</button><br>
                                </div><br>
                            </div>
                        </form>
                        <h2>{{ __('messages.comment') }}</h2>
                        @foreach($c as $comment)
                            <p >{{$comment->content}}</p>
                            <small>
                                {{ __('messages.author') }}:{{$comment->user->name}},  {{$comment->created_at}}
                            </small>
                            <div class="btn-group btn-group" >
                                @can('edit', $comment)
                                    <a href="{{route('comment.edit', $comment->id)}}" class="btn btn-outline-primary">{{ __('messages.edit') }}</a><br>
                                @endcan
                                @can('delete', $comment)
                                <form action="{{route('comments.destroy',$comment->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger">{{ __('messages.delete') }}</button>
                                </form>
                                @endcan
                            </div>
                        @endforeach
                        <br>
                    </div>
                </div>
    </div>
@endsection
{{--
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>


    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
<a href="{{ route('products.index') }}">Go to index page</a>
<div>

    <h1 >{{$product->title}}</h1>
    <p >{{$product->content}}</p>
    <form action="{{route('comment.store')}}" method="post">
        @csrf

        <div class="form-group">
            <label for="contentInput" >Comment:</label><br>
            <textarea class="form-control" id="contentInput" rows="3"  name="content"></textarea>
            <input type="hidden" value="{{$product->id}}" name="product_id">
            <br>
            <div class="form-group mt-3">
                <button  type="submit">Save Comment</button><br>
            </div><br>
        </div>
    </form>

    <h2>Comments:</h2>

    @foreach($c as $comment)
        <textarea >{{$comment->content}}</textarea>
        <a href="{{route('comment.edit', $comment->id)}}" >Edit comment</a><br>
        <form action="{{route('comments.destroy',$comment->id)}}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    @endforeach
    <br>

    <a href="{{route('products.edit',$product->id)}}">Edit</a>

</div>
</body>

</html>
--}}
