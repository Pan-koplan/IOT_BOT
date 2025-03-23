@extends('maket')
@section('title')
    <?= $gift->name ?>
@endsection
@section('content')
    <link rel="stylesheet" href="{{ asset('css/product_page.css') }}">
    <link rel="stylesheet" href="{{ asset('css/suggest.css') }}">
    <div class="main_container">
        <div class="content">
            <div class="container">
                <!-- Левая часть: Карусель изображений -->
                <div class="carousel">
                    <div class="carousel-thumbs">
                        @php
                            $indexx = 0; // Инициализация переменной
                        @endphp
                        @foreach ($photos as $index => $photo)
                            <img src="{{ Storage::disk('ycs3')->url($photo) }}"
                                onclick="changeImage('{{ Storage::disk('ycs3')->url($photo) }}')" alt="{{ $gift->name }}"
                                data-index="{{ $indexx }}">
                            @php
                                $indexx += 1; // Увеличение без вывода
                            @endphp
                        @endforeach
                    </div>
                    <img id="mainImage" src='{{ Storage::disk('ycs3')->url($photos[0]) }}' onclick="changeMainImage()"
                        class="main-image" alt="Основное изображение">
                </div>

                <!-- Правая часть: Информация о продукте -->
                <div class="product-info">
                    <div class="product_title_line">
                        <h1 class="product-title"><?= $gift->name ?></h1>
                        <p class="product-price"><?= $gift->cost ?></p>
                    </div>
                    <div class="buttons_mobile">
                        <a href="<?= $gift->link ?>"><button class="button"><svg height="512" viewBox="0 0 512 512"
                                    width="512" xmlns="http://www.w3.org/2000/svg">
                                    <title />
                                    <path
                                        d="M456.69,421.39,362.6,327.3a173.81,173.81,0,0,0,34.84-104.58C397.44,126.38,319.06,48,222.72,48S48,126.38,48,222.72s78.38,174.72,174.72,174.72A173.81,173.81,0,0,0,327.3,362.6l94.09,94.09a25,25,0,0,0,35.3-35.3ZM97.92,222.72a124.8,124.8,0,1,1,124.8,124.8A124.95,124.95,0,0,1,97.92,222.72Z"
                                        fill="currentColor" />
                                </svg>
                            </button></a>
                        <button onclick="addToFavorite_in_page({{ $gift->id }})"
                            class="button {{ Auth::user()?->gifts->contains($gift->id) ? ' active' : '' }}"
                            id="fav_button"><svg id="fav_icon" height="512px" style="enable-background:new 0 0 512 512;"
                                version="1.1" viewBox="0 0 512 512" width="512px" xml:space="preserve"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <path
                                    d="M365.4,59.628c60.56,0,109.6,49.03,109.6,109.47c0,109.47-109.6,171.8-219.06,281.271    C146.47,340.898,37,278.568,37,169.099c0-60.44,49.04-109.47,109.47-109.47c54.73,0,82.1,27.37,109.47,82.1    C283.3,86.999,310.67,59.628,365.4,59.628z"
                                    fill="currentColor" />
                            </svg>
                        </button>
                        <button class="button"
                            onClick='window.open("https://telegram.me/share/url?url={{ url()->current() }}","sharer","status=0,toolbar=0,width=650,height=500");'
                            title="Поделиться в Телеграм"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <title />
                                <path
                                    d="M18,21H6a3,3,0,0,1-3-3V6A3,3,0,0,1,6,3h4a1,1,0,0,1,0,2H6A1,1,0,0,0,5,6V18a1,1,0,0,0,1,1H18a1,1,0,0,0,1-1V14a1,1,0,0,1,2,0v4A3,3,0,0,1,18,21Z"
                                    fill="currentColor" />
                                <path
                                    d="M21,4.05v5a1,1,0,0,1-.62.92.84.84,0,0,1-.38.08,1,1,0,0,1-.71-.29L17.45,8l-4.79,4.79a1,1,0,0,1-1.42,0,1,1,0,0,1,0-1.42L16,6.55,14.24,4.76A1,1,0,0,1,14,3.67,1,1,0,0,1,15,3.05h5a.73.73,0,0,1,.25,0,.37.37,0,0,1,.14,0,.94.94,0,0,1,.53.53.37.37,0,0,1,0,.14A.73.73,0,0,1,21,4.05Z"
                                    fill="currentColor" />
                            </svg>
                        </button>
                    </div>
                    <?= $description ?>
                    <div class="gap"></div>
                    <div class="buttons">
                        <a href="<?= $gift->link ?>"><button class="button"><svg height="512" viewBox="0 0 512 512"
                                    width="512" xmlns="http://www.w3.org/2000/svg">
                                    <title />
                                    <path
                                        d="M456.69,421.39,362.6,327.3a173.81,173.81,0,0,0,34.84-104.58C397.44,126.38,319.06,48,222.72,48S48,126.38,48,222.72s78.38,174.72,174.72,174.72A173.81,173.81,0,0,0,327.3,362.6l94.09,94.09a25,25,0,0,0,35.3-35.3ZM97.92,222.72a124.8,124.8,0,1,1,124.8,124.8A124.95,124.95,0,0,1,97.92,222.72Z"
                                        fill="currentColor" />
                                </svg>
                                <div>Перейти в магазин</div>
                            </button></a>
                        <button onclick="addToFavorite({{ $gift->id }})" id="{{ $gift->id }}"
                            class="button{{ Auth::user()?->gifts->contains($gift->id) ? ' active' : '' }}">
                            <svg id="fav_icon" height="512px" style="enable-background:new 0 0 512 512;" version="1.1"
                                viewBox="0 0 512 512" width="512px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                <path
                                    d="M365.4,59.628c60.56,0,109.6,49.03,109.6,109.47c0,109.47-109.6,171.8-219.06,281.271    C146.47,340.898,37,278.568,37,169.099c0-60.44,49.04-109.47,109.47-109.47c54.73,0,82.1,27.37,109.47,82.1    C283.3,86.999,310.67,59.628,365.4,59.628z"
                                    fill="currentColor" />
                            </svg>
                            <div>В избранное</div>
                        </button>
                        <button class="button"
                            onClick='window.open("https://telegram.me/share/url?url={{ url()->current() }}","sharer","status=0,toolbar=0,width=650,height=500");'
                            title="Поделиться в Телеграм"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <title />
                                <path
                                    d="M18,21H6a3,3,0,0,1-3-3V6A3,3,0,0,1,6,3h4a1,1,0,0,1,0,2H6A1,1,0,0,0,5,6V18a1,1,0,0,0,1,1H18a1,1,0,0,0,1-1V14a1,1,0,0,1,2,0v4A3,3,0,0,1,18,21Z"
                                    fill="currentColor" />
                                <path
                                    d="M21,4.05v5a1,1,0,0,1-.62.92.84.84,0,0,1-.38.08,1,1,0,0,1-.71-.29L17.45,8l-4.79,4.79a1,1,0,0,1-1.42,0,1,1,0,0,1,0-1.42L16,6.55,14.24,4.76A1,1,0,0,1,14,3.67,1,1,0,0,1,15,3.05h5a.73.73,0,0,1,.25,0,.37.37,0,0,1,.14,0,.94.94,0,0,1,.53.53.37.37,0,0,1,0,.14A.73.73,0,0,1,21,4.05Z"
                                    fill="currentColor" />
                            </svg>
                            <div>Поделиться</div>
                        </button>
                    </div>
                </div>
            </div>
            <div class="gap"></div>
            <div class="gap_line"></div>
            <div class="suggest_product">
                <div class="gap"></div>
                <div class="title_center">Похожие товары</div>

                <div class="product_line" id="gifts-container">
                    @include('partials.gifts', ['gifts' => $gifts])
                </div>
                <div class="gap"></div>
                <button class="button" id="load-more-button">Показать ещё</button>
                <div class="gap"></div>
            </div>
        </div>
        <script>
            const mainImage = document.getElementById("mainImage");

            function changeImage(src) {
                document.getElementById("mainImage").src = src;
            }

            var index = 1;
            const photos = @json($photos);

            function changeMainImage() {
                const photos = document.querySelectorAll('.carousel-thumbs img');
                document.getElementById("mainImage").src = photos[index].src; // Устанавливаем src из массива

                // Логика переключения
                if (index < photos.length - 1) {
                    index += 1; // Увеличиваем, если не последний элемент
                } else {
                    index = 0; // Возвращаемся к началу
                }
            }

            const button = document.querySelector('#fav_button');
            const circle = document.getElementById("fav_icon");

            function addToFavorite_in_page(id) {
                document.getElementById(id).classList.toggle('active');

                @if (Auth::check())
                    fetch(`/favorite_add/${id}`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}', // CSRF-токен
                                'Content-Type': 'application/json',
                            },
                        })
                        .then(response => {
                            console.log(response);
                            return response.text();
                            // response.json()

                        })
                        .then(data => {
                            //console.log('Ответ сервера:', data); // Посмотрите, что пришло
                            const parsedData = JSON.parse(data); // Попробуйте разобрать
                            // console.log('Успех:', data);
                            // alert('Добавлено в избранное!');
                        })
                        .catch(error => console.error('Ошибка:', error));
                @else
                    window.location.href = '/Auth';
                @endif
            }
        </script>
    @endsection
