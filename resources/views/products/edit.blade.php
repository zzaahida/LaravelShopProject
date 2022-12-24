
@extends('layouts.app')

@section('title','EDIT PAGE')

@section('content')

    <div class="container">
        <a href="{{ route('products.index') }}">{{ __('messages.index') }}</a>
        <div class="row">
            <div class="col-sm-12">
                <form action="{{route('products.update',$product->id)}}" method="post" >
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="titleInput">{{ __('messages.title') }}:</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="titleInput" name="title">
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="contentInput">{{ __('messages.content') }}:</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" id="contentInput" rows="3" name="content"></textarea>
                        @error('content')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="priceInput">{{ __('messages.price') }}:</label>
                        <textarea class="form-control @error('price') is-invalid @enderror" id="priceInput" rows="1" name="price"></textarea>
                        @error('price')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="categoryInput">{{ __('messages.category') }}:</label>
                        <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="categoryInput">
                            @foreach($categories as $cat)
                                <option value="{{$cat->id}}">{{$cat->{'name_'.app()->getLocale()} }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-outline-primary" type="submit">{{ __('messages.update') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

