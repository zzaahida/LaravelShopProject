@extends('layouts.adm')

@section('title','Comments page')

@section('content')
    <h2>{{ __('messages.comment') }}</h2>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">{{ __('messages.comment') }}</th>
            <th scope="col">{{ __('messages.user') }}</th>
            <th scope="col">{{ __('messages.title') }}</th>
            <th scope="col">###</th>
            <th scope="col">###</th>

        </tr>
        </thead>
        <tbody>
        @foreach($comment as $c)
            <tr>
                <td>{{$c->content}}</td>
                <td>{{$c->user->name}}</td>
                <td>{{$c->product->title}}</td>
                <td>
                    <form action="{{route('comments.destroy',$c->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger">{{ __('messages.delete') }}</button>
                    </form>
                </td>
                <td>
                    <form action="{{route('products.show',$c->product_id)}}" method="get">
                        <button class="btn btn-outline-primary">{{ __('messages.show') }}</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
