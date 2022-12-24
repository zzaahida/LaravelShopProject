@extends('layouts.adm')

@section('title','Cart page')

@section('content')
    <h2>{{ __('messages.car') }}</h2>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">###</th>
            <th scope="col">{{ __('messages.title') }}</th>
            <th scope="col">{{ __('messages.user') }}</th>
            <th scope="col">{{ __('messages.size') }}</th>
            <th scope="col">{{ __('messages.count') }}</th>
            <th scope="col">{{ __('messages.status') }}</th>
            <th>#</th>

        </tr>
        </thead>
        <tbody>
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
                        <button class="btn btn-outline-success">{{ __('messages.confirm') }}</button>
                    </form></td>
            </tr>
        @endfor
        </tbody>
    </table>
@endsection
