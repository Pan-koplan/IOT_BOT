@extends('maket')
@section('title')
    Популярные подарки
@endsection
@section('content')
    {{-- @dd(Auth::check()) --}}

    <link rel="stylesheet" href="{{ asset('css/suggest.css') }}">
    <div class="main_container">
        <div class="content">
            <div class="gap"></div>
            <div class="suggest_product">

                <div class="title_center">Популярные подарки</div>

                <div class="product_line" id="gifts-container">
                    @include('partials.gifts', ['gifts' => $gifts])
                </div>
                <div class="gap"></div>
                <button class="button" id="load-more-button">Показать ещё</button>
                <div class="gap"></div>

            </div>

        </div>
    @endsection
