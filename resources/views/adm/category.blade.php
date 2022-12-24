@extends('layouts.adm')

@section('title','Categories page')

@section('content')
    <h2>{{ __('messages.category') }}</h2>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">{{ __('messages.category') }}</th>
            <th scope="col">{{ __('messages.delete') }}</th>

        </tr>
        </thead>
        @foreach($category as $cat)
            <tr>
                <td>{{$cat->name}}</td>
                <td>
                    <form action="{{route('adm.categories.destroy',$cat->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger">{{ __('messages.delete') }}</button>
                    </form></td>


            </tr>
        @endforeach
        <a href="{{route('adm.categories.create')}}">{{ __('messages.create') }}</a>
        </tbody>
    </table>
@endsection
