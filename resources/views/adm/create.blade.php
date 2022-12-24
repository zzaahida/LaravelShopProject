@extends('layouts.adm')

@section('title','EDIT PAGE')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <form action="{{route('adm.categories.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="titleInput">{{ __('messages.ne') }}:</label>
                        <input type="text" class="form-control " id="nameInput" name="name">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="titleInput">{{ __('messages.ne') }}:</label>
                        <input type="text" class="form-control " id="name_enInput" name="name_en">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="titleInput">{{ __('messages.nk') }}:</label>
                        <input type="text" class="form-control " id="name_kzInput" name="name_kz">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="titleInput">{{ __('messages.nr') }}:</label>
                        <input type="text" class="form-control " id="name_ruInput" name="name_ru">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="titleInput">{{ __('messages.code') }}:</label>
                        <input type="text" class="form-control " id="codeInput" name="code">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group mt-3">
                        <button  type="submit">{{ __('messages.save') }}</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
