@extends('maket')
@section('title')
    Избранное
@endsection
@section('content')
    <link rel="stylesheet" href="{{ asset('css/suggest.css') }}">
    <div class="main_container">
        <div class="content">
            <div class="gap"></div>
            <div class="suggest_product">
                <div class="title_center">Ваши любимые подарки</div>

                <div class="product_line" id="gifts-container">
                    @include('partials.gifts', ['gifts' => $gifts])
                </div>
                <div class="gap"></div>
                <button class="button" id="load-more-button">Показать ещё</button>
                <div class="gap"></div>


            </div>

        </div>
        <script>
            function addToFavorite(id) {
                fetch(`/favorite_add/${id}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}', // CSRF-токен
                            'Content-Type': 'application/json',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Успех:', data);
                        alert('Добавлено в избранное!');
                    })
                    .catch(error => console.error('Ошибка:', error));
            }
        </script>
    @endsection
