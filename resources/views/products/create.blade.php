@extends('layouts.app')

@section('title','CREATE PAGE')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-10">
                <a  href="{{ route('products.index') }}" class="btn btn-outline-primary">{{ __('messages.index') }}</a>
                <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="titleInput">{{ __('messages.title') }}</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="titleInput" name="title" >
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="contentInput">{{ __('messages.content') }}</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" id="contentInput" rows="3" name="content"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="contentInput">{{ __('messages.price') }}</label>
                        <textarea class="form-control @error('price') is-invalid @enderror" id="priceInput" rows="1" name="price"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="categoryInput">{{ __('messages.category') }}</label>
                        <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="categoryInput">
                            @foreach($categories as $cat)
                                <option value="{{$cat->id}}">{{$cat->{'name_'.app()->getLocale()} }}</option>
                            @endforeach

                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="contentInput">{{ __('messages.image') }}</label>
                        <input type="file" class="form-control @error('img') is-invalid @enderror" id="imgInput" name="img">
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="form-group mt-3">
                        <button  type="submit">{{ __('messages.save') }}</button>
                    </div>

                </form>
            </div>
        </div>
    </div>



@endsection
