@extends('layouts.app')

@section('title','CREATE PAGE')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-10">
                <a  href="{{ route('products.index') }}" class="btn btn-outline-primary">Go to index page</a>
                <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="titleInput">Title:</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="titleInput" name="title" placeholder="Enter text">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="contentInput">Content:</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" id="contentInput" rows="3" name="content"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="contentInput">Price:</label>
                        <textarea class="form-control @error('price') is-invalid @enderror" id="priceInput" rows="1" name="price"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="categoryInput">Category:</label>
                        <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="categoryInput">
                            @foreach($categories as $cat)
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                            @endforeach

                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="contentInput">Image:</label>
                        <input type="file" class="form-control @error('img') is-invalid @enderror" id="imgInput" name="img">
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="form-group mt-3">
                        <button  type="submit">Save Product</button>
                    </div>

                </form>
            </div>
        </div>
    </div>



@endsection
