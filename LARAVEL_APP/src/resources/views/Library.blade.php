@extends('maket')
@section('title')
    Подборки подарков
@endsection

@section('content')
    <link rel="stylesheet" href="{{ asset('css/articles_gate_page.css') }}">
    <div class="main_container">
        <div class="article-content">
            <div class="main-content-line">
                <a href="{{ url('/article/' . $articles[0]->id) }}">
                    <div class="main-content-item-big">
                        <div class="item-content-big"
                            style="
                            background: linear-gradient(
                                0deg,
                                rgba(0, 0, 0, 1) 0%,
                                rgba(0, 0, 0, 0) 100%
                              ),
                              url({{ Storage::disk('ycs3')->url('Images/item-content-big0.png') }}) center;
                            background-size: cover;
                            background-repeat: no-repeat;">
                            <div class="title_big">
                                Топ 10 подарков на день рождения в 2025 году
                            </div>
                            <div class="item-metadata">
                                <div>#Для нее #День рождения</div>
                            </div>
                        </div>
                    </div>
                </a>
                @foreach ($articles as $article)
                    <a href="{{ url('/article/' . $article->id) }}">
                        <div class="main-content-item">
                            <div class="main-content-item-content">
                                <img class="item-content-photo" src="{{ Storage::disk('ycs3')->url($article->image) }}" />
                                <div class="title">
                                    {{ $article->title }}
                                </div>
                                <div class="item-metadata">
                                    <div class="tag">#Для нее #14 февраля</div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach

            </div>
        </div>
    @endsection
