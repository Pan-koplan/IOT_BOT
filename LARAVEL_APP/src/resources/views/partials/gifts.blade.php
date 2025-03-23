@foreach ($gifts as $gift)
    <div class="featured-products">
        <button onclick="addToFavorite({{ $gift->id }})" id="{{ $gift->id }}"
            class="favorite{{ Auth::user()?->gifts->contains($gift->id) ? ' active' : '' }}">
            <svg height="512px" style="enable-background: new 0 0 512 512" version="1.1" viewBox="0 0 512 512"
                width="512px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink">
                <g id="_x31_66_x2C__Heart_x2C__Love_x2C__Like_x2C__Twitter">
                    <g>
                        <path
                            d="M365.4,59.628c60.56,0,109.6,49.03,109.6,109.47c0,109.47-109.6,171.8-219.06,281.271    C146.47,340.898,37,278.568,37,169.099c0-60.44,49.04-109.47,109.47-109.47c54.73,0,82.1,27.37,109.47,82.1    C283.3,86.999,310.67,59.628,365.4,59.628z" />
                    </g>
                </g>
                <g id="Layer_1" />
            </svg>
        </button>
        <a href={{ url('/gift/' . $gift->id) }}>
            <?php
            $photo_url = str($gift->id);
            $photo = '/Images/wbshkaa_' . $photo_url . '_1.jpg';
            ?>

            <img src="{{ Storage::disk('ycs3')->url($photo) }}" class="product_image" alt={{ $gift->name }}>
            <p class="price">{{ $gift->cost }}</p>
            <div class="product-name">
                <p class="product-name2">{{ $gift->name }}</p>
                <p class="sort-description">Stylish cafe chair</p>
            </div>
        </a>
        <div class="cost"></div>
    </div>
@endforeach
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const loadMoreButton = document.getElementById('load-more-button');
        const giftsContainer = document.getElementById('gifts-container');
        let offset = {{ $gifts->count() }}; // Начальное смещение

        loadMoreButton.addEventListener('click', function() {
            fetch(`/load-more-gifts?offset=${offset}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest' // Указываем, что это AJAX-запрос
                    }
                })
                .then(response => response.json())
                .then(data => {
                    giftsContainer.insertAdjacentHTML('beforeend', data
                        .html); // Добавляем новые элементы
                    offset = data.nextOffset; // Обновляем смещение

                    // Скрываем кнопку, если больше нет данных
                    if (data.html.trim() === '') {
                        loadMoreButton.style.display = 'none';
                    }
                })
                .catch(error => console.error('Ошибка:', error));
        });
    });
</script>
