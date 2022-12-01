@extends('layouts.app')

@section('title','Your cart')

@section('content')
    <h2>Your cart</h2>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Size</th>
            <th scope="col">Number</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        @for($i=0;$i<count($productsSize); $i++)
            <tr>
                <th scope="row">{{$i+1}}</th>
                <td>{{$productsSize[$i]->title}}</td>
                <td>{{$productsSize[$i]->pivot->size}}</td>
                <td>{{$productsSize[$i]->pivot->number}}</td>
                <td>
                    <a class="btn btn-outline-success" href="{{route('products.show', $productsSize[$i])}}">Update</a>
                </td>
                <td>
                    <form action="{{route('products.uncart', $productsSize[$i])}}" method="post">
                        @csrf
                        <button style="float:left;" class="btn btn-outline-danger" type="submit">Delete from Cart</button>
                    </form>
                </td>
            </tr>
        @endfor
        </tbody>
    </table>
    <form action="{{route('products.buy')}}" method="post">
        @csrf
        <button  class="btn btn-outline-primary" type="submit">Buy all</button>
    </form><form
@endsection
