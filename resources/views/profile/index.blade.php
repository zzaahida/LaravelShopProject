@extends('layouts.app')

@section('title','Profile page')

@section('content')
    <div class="container">
        <a class="btn btn-outline-primary" href="{{ route('products.index') }}">{{ __('messages.index') }}</a>
        <div class="card" >
            <div class="card-header">
                <h3>{{__('messages.profile')}}</h3>
            </div>
            <div class="card-body">
                <img src="{{asset(Auth::user()->img)}}" width="120px">
                <h5 class="card-title">{{ __('messages.name') }}:    {{Auth::user()->name }}</h5>
                <p class="card-text">{{ __('messages.account') }}:    {{Auth::user()->account}} {{ __('messages.tenge') }}</p><hr>
                <a href="{{route('profile.edit',Auth::user()->id)}}" class="btn btn-outline-primary">{{ __('messages.edit') }}</a>
            </div>
            <div class="card-footer">
                <button class="btn btn-outline-secondary" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('messages.logout') }}
                </button>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                <br>
                <a class="btn btn-outline-success" href="{{ route('products.orders') }}">
                    {{ __('messages.orders') }}
                </a>

            </div>
        </div>
    </div>
@endsection
