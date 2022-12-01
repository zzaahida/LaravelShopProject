@extends('layouts.app')

@section('title','HOME PAGE')

@section('content')
    <div class="container" style="flex-direction: row">
        @can('create', App\Models\Product::class)
            <a class="btn btn-outline-primary" href="{{ route('products.create') }}">Go to create page</a>
        @endcan
        <div class="row" >
                @foreach($products as $oneProduct)
                    <div class="card" style="width: 250px; margin: 15px">
                        <div class="card-header" >
                            <h5 class="card-title">{{$oneProduct->title }}</h5>
                            <small>author: {{$oneProduct->user->name}}</small>
                        </div>
                        <div class="card-body" >
                            <p class="card-text">{{$oneProduct->content}}</p>
                            <hr>
                            <small class="text-muted">{{$oneProduct->price}} tenge </small>
                        </div>
                        <div class="card-footer">
                                <a href="{{route('products.show',$oneProduct->id)}}" class="btn btn-outline-primary" >Read more</a>
                                @can('delete', $oneProduct)
                                    <form action="{{route('products.show',$oneProduct->id)}}" method="post" >
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger"  type="submit">Delete</button>
                                    </form>
                                @endcan
                        </div>
                    </div>
                @endforeach
        </div>
    </div>
@endsection
{{--        <div class="row">
            <div class="row card-deck">
                <div class="row col-md-3">
                    @foreach($products as $oneProduct)
                        <div class="row card bg-light mb-3" >
                            <div class="card-body">
                                <h5 class="card-title">{{$oneProduct->title }}</h5>
                                <p class="card-text">{{$oneProduct->content}}</p>
                                <div class="row">
                                    <a href="{{route('products.show',$oneProduct->id)}}" class="btn btn-outline-primary">Read more</a>
                                    <form action="{{route('products.show',$oneProduct->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger" type="submit">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    --}}

{{--<a href="{{route('posts.index')}}">All Posts</a>
@foreach($categories as $cat)
    <a href="{{route('posts.category',$cat->id)}}">{{$cat->name}}</a>

@endforeach--}}

{{--}}<div>
    <a href="{{ route('posts.create') }}">Go to create page</a>
</div>

   <div>
       @foreach($posts as $onePost)
           <a href="{{route('posts.show',$onePost->id)}}"><h3>{{$onePost->title}}</h3></a>
           <p>{{$onePost->content}}</p>

           <form action="{{route('posts.show',$onePost->id)}}" method="post">
               @csrf
               @method('DELETE')
               <button type="submit">Delete</button>

           </form>
       @endforeach

   </div>
   --}}
