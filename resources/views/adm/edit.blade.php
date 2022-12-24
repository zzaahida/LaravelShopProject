@extends('layouts.adm')

@section('title','EDIT PAGE')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <form action="{{route('adm.users.update', $user->id)}}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="roleInput">{{ __('messages.role') }}:</label>
                        <select class="form-control @error('role_id') is-invalid @enderror" name="role_id" id="roleInput">
                            @foreach($role as $rol)
                                <option value="{{$rol->id}}">{{$rol->name}}</option>
                            @endforeach

                        </select>
                    </div>
                    <button class="btn btn-outline-primary" type="submit">{{ __('messages.save') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
