@extends('layouts.adm')

@section('title','Categories page')

@section('content')
    <h2>Category page</h2>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">###</th>
            <th scope="col">Category</th>

        </tr>
        </thead>
        @foreach($category as $cat)
            <tr>
                <td>{{$cat->name}}</td>
                <td>
                    <form action="{{route('adm.categories.destroy',$cat->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger">Delete</button>
                    </form></td>


            </tr>
        @endforeach
        <a href="{{route('adm.categories.create')}}">Create</a>
        </tbody>
    </table>
@endsection
