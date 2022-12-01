@extends('layouts.adm')

@section('title','EDIT PAGE')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <form action="{{route('adm.categories.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="titleInput">Name:</label>
                        <input type="text" class="form-control " id="nameInput" name="name" placeholder="Enter text">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="titleInput">Code:</label>
                        <input type="text" class="form-control " id="codeInput" name="code" placeholder="Enter text">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group mt-3">
                        <button  type="submit">Save Category</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
