@extends('layouts.app')

@section('title','PRODUCT PAGE')

@section('content')
    <div class="container">
        <a class="btn btn-outline-primary" href="{{ route('products.index') }}">Go to index page</a>
                <div class="card" >
                    <div class="card-header">
                        <h5 class="card-title">{{$product->title }}</h5>
                        <img src="{{asset($product->img)}}" >
                       </div>
                    <div class="card-body">
                        <p class="card-text">{{$product->content}}</p>
                        <small class="text-muted">{{$product->price}} tenge </small><hr>
                        <a href="{{route('products.edit',$product->id)}}" class="btn btn-outline-primary">Edit product</a>
                        @auth()
                            <form action="{{route('products.addcart', $product->id)}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="sizeInput">Size</label>
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
                                    <label for="numberInput">Kolichestvo</label>
                                    <input type="number" name="number" placeholder="1">
                                </div>
                                <button type="submit">select</button><br>
                            </form>
                        @endauth
                    </div>
                    <div class="card-footer">
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
                            <p >{{$comment->content}}</p>
                            <small>
                                {{$comment->created_at}}
                            </small>
                            <div class="btn-group btn-group" >
                                <a href="{{route('comment.edit', $comment->id)}}" class="btn btn-outline-primary">Edit comment</a><br>
                                @can('delete', $comment)
                                <form action="{{route('comments.destroy',$comment->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger">Delete</button>
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
