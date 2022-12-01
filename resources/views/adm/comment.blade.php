@extends('layouts.adm')

@section('title','Comments page')

@section('content')
    <h2>Comments page</h2>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Comment</th>
            <th scope="col">User name</th>
            <th scope="col">Product</th>
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
                        <button class="btn btn-outline-primary">Show comment</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
