@extends('layouts.adm')

@section('title','Cart page')

@section('content')
    <h2>Cart page</h2>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">###</th>
            <th scope="col">Title</th>
            <th scope="col">Name</th>
            <th scope="col">Size</th>
            <th scope="col">Number</th>
            <th scope="col">Status</th>
            <th>#</th>

        </tr>
        </thead>
        @for($i=1; $i <= count($productsSize); $i++)
            <tr>
                <th scope="row">{{$i}}</th>
                <td>{{$productsSize[$i-1]->product->title}}</td>
                <td>{{$productsSize[$i-1]->user->name}}</td>
                <td>{{$productsSize[$i-1]->size}}</td>
                <td>{{$productsSize[$i-1]->number}}</td>
                <td>{{$productsSize[$i-1]->status}}</td>
                <td>
                    <form action="{{route('adm.cart.confirm', $productsSize[$i-1]->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-outline-success">Confirm order</button>
                    </form></td>
            </tr>
        @endfor
        <a href="{{route('adm.categories.create')}}">Create</a>
        </tbody>
    </table>
@endsection
