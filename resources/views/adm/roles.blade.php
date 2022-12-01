@extends('layouts.adm')

@section('title','Roles page')

@section('content')
    <h2>Roles page</h2>
                    .

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Role</th>
            <th scope="col">Role id</th>

        </tr>
        </thead>
        <tbody>
        @for($i=0; $i<count($users); $i++)
            <tr>
                <th scope="row">{{$i+1}}</th>
                <td>{{$users[$i]->name}}</td>
                <td>{{$users[$i]->role->name}}</td>
                <td>{{$users[$i]->role_id}}</td>

            </tr>
        @endfor
        </tbody>
    </table>
@endsection

