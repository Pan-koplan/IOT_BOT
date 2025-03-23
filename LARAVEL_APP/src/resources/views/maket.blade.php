<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/maket.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vars.css') }}">

    <title>@yield('title')</title>
</head>

<body>
    <header>
        <div class="header">
            <div class="header-main-line">
                <div class="header-main-line-left">
                    <a class="logo" href="/"><img src="{{ Storage::disk('ycs3')->url('Images/head.svg') }}"
                            alt="">
                        <p class="logo_name">Giftiks</p>
                    </a>
                </div>
                <nav class="header-main-line-right">

                    <ul class="navig_line">
                        <li class="nav"><a href="/">Подбор</a></li>
                        <li class="nav"><a href="/catalog">Коллекция</a></li>
                        <li class="nav"><a href="/library">Подборки</a></li>
                    </ul>
                    <a href="/favorite">
                        <svg class="akar-icons" onclick="openModal()" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24">
                            <path
                                d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                        </svg>
                    </a>
                    {{-- <a href="/search">
                        <svg class="akar-icons" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path
                                d="M10 2a8 8 0 0 1 5.29 13.71l4.7 4.7-1.41 1.41-4.7-4.7A8 8 0 1 1 10 2m0 2a6 6 0 1 0 0 12A6 6 0 0 0 10 4" />
                        </svg>
                    </a> --}}
                    <div class="burger">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </nav>

            </div>


        </div>
    </header>
    </div>


    <div style="flex: 1;">@yield('content')</div>
    <footer class="footer">
        <div class="footer-content">
            <p class="footer-title"><strong>Giftiks.</strong></p>
            <p class="footer-contact">Коммерческая связь: <a href="mailto:giftiks@gmail.com">giftiks@gmail.com</a></p>
        </div>
        <hr class="footer-line">
        <p class="footer-copyright">2025 Giftiks. All rights reserved</p>
    </footer>
    <div class="hamburger_menu">
        <ul>
            <li class="nav_active"><a href="/">Подбор</a></li>
            <li class="nav"><a href="/catalog">Коллекция</a></li>
            <li class="nav"><a href="/library">Подборки</a></li>
        </ul>
    </div>

    <script>
        const burger = document.querySelector(".burger");
        const navMenu = document.querySelector('.hamburger_menu');
        burger.addEventListener('click', () => {
            burger.classList.toggle('active');
            navMenu.classList.toggle('active');
        });

        // Закрытие меню при клике вне его области
        document.addEventListener('click', (event) => {
            if (!event.target.closest('.nav-menu') && !event.target.closest('.burger')) {
                burger.classList.remove('active');
                navMenu.classList.remove('active');
            }
        });

        let lastScroll = 0;
        let sensitivity = 60; // Чувствительность к изменению скролла
        const header = document.querySelector("menu_btn");

        window.addEventListener("scroll", () => {
            let currentScroll = window.scrollY;
            let scrollDifference = Math.abs(currentScroll - lastScroll);

            if (currentScroll > lastScroll && scrollDifference > sensitivity) {
                header.classList.add("hidden"); // Скрыл при скролле вниз
            } else if (currentScroll < lastScroll && scrollDifference > sensitivity) {
                header.classList.remove("hidden"); // Показал при скролле вверх
            }
            // Если скролл вверх ИЛИ пользователь в самом верху страницы
            else if (currentScroll === 0) {
                header.classList.remove("hidden"); // Показываем шапку
            }

            lastScroll = currentScroll;
        });

        function openModal() {
            document.getElementById('modalOverlay').classList.add('active');
        }

        function closeModal() {
            document.getElementById('modalOverlay').classList.remove('active');
        }

        function autoResize(textarea) {
            textarea.style.height = "auto"; // Сбрасываем высоту
            textarea.style.height = textarea.scrollHeight + "px"; // Задаем новую высоту
        }
        document.querySelectorAll('.switcher-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                // Убираем активный класс у всех кнопок
                document.querySelectorAll('.switcher-btn').forEach(b => b.classList.remove('active'));

                // Добавляем активный класс текущей кнопке
                this.classList.add('active');

                // Скрываем все текстовые блоки
                document.querySelectorAll('.text-block').forEach(block => block.classList.remove('active'));

                // Показываем целевой текстовый блок
                const target = this.getAttribute('data-target');
                document.getElementById(target).classList.add('active');
            });
        });

        function addToFavorite(id) {
            const button = event.target;
            document.getElementById(id).classList.toggle('active');
            @if (Auth::check())
                console.log('auth_apoved');
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
                        console.log('Ответ сервера:', data); // Посмотрите, что пришло
                        const parsedData = JSON.parse(data); // Попробуйте разобрать
                        // console.log('Успех:', data);
                        // alert('Добавлено в избранное!');
                    })
                    .catch(error => console.error('Ошибка:', error));
            @else
                window.location.href = '/Auth';
            @endif
        }
        // $(document).ready(function() {

        //     $('#submit').on('click', function() {
        //         const email = $('#email').val();
        //         var url = $(this).attr("action");
        //         if (email.length > 0) {
        //             $.ajax({
        //                 type: 'POST',
        //                 url: url,
        //                 data: email,
        //                 contentType: false,
        //                 processData: false,
        //                 success: (response) => {
        //                     alert('Form submitted successfully');
        //                     location.reload();
        //                 }
        //             });
        //         } else {
        //             $('#emailStatus').text('Поле email не может быть пустым.');
        //         }
        //     });
        // });
    </script>
</body>

</html>
