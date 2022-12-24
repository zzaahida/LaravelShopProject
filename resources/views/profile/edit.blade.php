@extends('layouts.app')

@section('title','EDIT PAGE')

@section('content')

    <div class="container">
        <a href="{{ route('products.index') }}">{{ __('messages.index') }}</a>
        <div class="row">
            <div class="col-sm-12">
                <form action="{{route('profile.update', Auth::user()->id)}}" method="post" >
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="titleInput">{{ __('messages.name') }}:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="nameInput" name="name">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="priceInput">{{ __('messages.account') }}:</label>
                        <textarea class="form-control @error('account') is-invalid @enderror" id="accountInput" rows="1" name="account"></textarea>
                        @error('account')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-outline-primary" type="submit">{{ __('messages.update') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

