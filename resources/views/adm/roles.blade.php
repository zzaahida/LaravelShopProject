@extends('layouts.adm')

@section('title','Roles page')

@section('content')
    <h2>{{ __('messages.role') }}</h2>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{ __('messages.name') }}</th>
            <th scope="col">{{ __('messages.role') }}</th>
            <th scope="col">{{ __('messages.role') }} id</th>
            <th scope="col">###</th>

        </tr>
        </thead>
        <tbody>
        @for($i=0; $i<count($users); $i++)
            <tr>
                <th scope="row">{{$i+1}}</th>
                <td>{{$users[$i]->name}}</td>
                <td>{{$users[$i]->role->name}}</td>
                <td>{{$users[$i]->role_id}}</td>
                <td><a href="{{route('adm.users.edit', $users[$i]->id)}}">{{ __('messages.edit') }}</a> </td>
            </tr>
        @endfor
        </tbody>
    </table>
@endsection

