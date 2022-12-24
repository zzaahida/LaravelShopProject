@extends('layouts.adm')

@section('title','Users page')

@section('content')
    <h2>{{ __('messages.user') }}</h2>

    <form action="{{route('adm.users.search')}}" method="GET">
        <div class="input-group mb-3">
            <input type="text" name="search" class="form-control" placeholder="{{ __('messages.search') }}" aria-label="Recipient's username" aria-describedby="basic-addon2">
            <button class="btn btn-primary" type="submit">{{ __('messages.search') }}</button>
        </div>
    </form>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{ __('messages.name') }}</th>
            <th scope="col">E-mail</th>
            <th scope="col">{{ __('messages.role') }}</th>
            <th scope="col">###</th>

        </tr>
        </thead>
        <tbody>
            @for($i=0; $i<count($users); $i++)
                <tr>
                    <th scope="row">{{$i+1}}</th>
                    <td>{{$users[$i]->name}}</td>
                    <td>{{$users[$i]->email}}</td>
                    <td>{{$users[$i]->role->name}}</td>
                    <td>
                        <form action="
                        @if($users[$i]->is_active)
                             {{route('adm.users.ban', $users[$i]->id)}}
                        @else
                             {{route('adm.users.unban', $users[$i]->id)}}
                        @endif
                        " method="post">
                            @csrf
                            @method('PUT')
                            <button class="btn {{$users[$i]->is_active ? 'btn-outline-danger' : 'btn-outline-success'}}" type="submit">
                                @if($users[$i]->is_active)
                                    {{ __('messages.ban') }}
                                @else
                                    {{ __('messages.unban') }}
                                @endif
                            </button>
                        </form>
                    </td>
                </tr>
            @endfor
        </tbody>
    </table>
@endsection
