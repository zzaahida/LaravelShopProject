@extends('layouts.app')

@section('title','Your cart')

@section('content')
    <div class="container">
        <a class="btn btn-outline-primary" href="{{ route('products.index') }}">{{ __('messages.index') }}</a>
        <div class="card" >
            <h2 style="text-align: center">{{ __('messages.cart') }}</h2>
            <br>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('messages.product') }}</th>
                    <th scope="col">{{ __('messages.size') }}</th>
                    <th scope="col">{{ __('messages.count') }}</th>
                    <th scope="col">{{ __('messages.price') }}</th>
                    <th>{{ __('messages.update') }}</th>
                    <th>{{ __('messages.delete') }}</th>
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
                        <td>
                            <a class="btn btn-outline-success" href="{{route('products.show', $productsSize[$i])}}">{{ __('messages.update') }}</a>
                        </td>
                        <td>
                            <form action="{{route('products.uncart', $productsSize[$i])}}" method="post">
                                @csrf
                                <button style="float:left;" class="btn btn-outline-danger" type="submit">{{ __('messages.delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @endfor
                </tbody>
            </table><br>
            <h4>{{__('messages.sum')}}: {{$sum}} {{__('messages.tenge')}}</h4><br>
            <form action="{{route('products.buy')}}" method="post">
                @csrf
                <button  class="btn btn-outline-primary" type="submit">{{ __('messages.buy') }}</button>
            </form>
        </div>
    </div>
@endsection
