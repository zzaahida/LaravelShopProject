@extends('layouts.app')

@section('title','Your orders')

@section('content')
    <div class="container">
        <a class="btn btn-outline-primary" href="{{ route('products.index') }}">{{ __('messages.index') }}</a>
        <div class="card" >
            <h2 style="text-align: center">{{ __('messages.orders') }}</h2>
            <br>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('messages.product') }}</th>
                    <th scope="col">{{ __('messages.size') }}</th>
                    <th scope="col">{{ __('messages.count') }}</th>
                    <th scope="col">{{ __('messages.price') }}</th>
                    <th scope="col">{{ __('messages.status') }}</th>
                </tr>
                </thead>
                <tbody>
                @for($i=0;$i<count($productsSize); $i++)
                    <tr>
                        <th scope="row">{{$i+1}}</th>
                        <td>{{$productsSize[$i]->title}}</td>
                        <td>{{$productsSize[$i]->pivot->size}}</td>
                        <td>{{$productsSize[$i]->pivot->number}}</td>
                        <td>{{$productsSize[$i]->price}}</td>
                        <td>{{$productsSize[$i]->pivot->status}}</td>
                    </tr>
                @endfor
                </tbody>
            </table>
        </div>
    </div>
@endsection
