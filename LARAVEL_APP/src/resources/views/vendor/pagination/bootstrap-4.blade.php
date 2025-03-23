@extends('maket')
@section('title')<?= $gift->name ?>@endsection
@section('content')
  <div class="main_container">
    <div class="main-content">
        <div class="container">
            <!-- Левая часть: Карусель изображений -->
            <div class="carousel">
                <div class="carousel-thumbs">
                    @php
                        $indexx = 0; // Инициализация переменной
                    @endphp
                    @foreach ($photos as $index => $photo)
                        <img src="{{ Storage::url($photo) }}" onclick="changeImage('{{ Storage::url($photo) }}')" alt="{{ $gift->name }}" data-index="{{ $indexx }}">
                        @php
                            $indexx += 1; // Увеличение без вывода
                        @endphp
                    @endforeach
                </div>
                <img id="mainImage" src='{{Storage::url($photos[0])}}' onclick="changeMainImage()" class="main-image" alt="Основное изображение">
            </div>
        
            <!-- Правая часть: Информация о продукте -->
            <div class="product-info">
                <div class="product_title_line">
                  <h1 class="product-title"><?= $gift->name ?></h1>
                  <p class="product-price"><?= $gift->cost ?></p>
                </div>
                <?= $description ?>
                <div class="gap"></div>
                <div class="buttons">
                  <a href="<?= $gift->link ?>"><button class="button"><svg height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg"><title/><path d="M456.69,421.39,362.6,327.3a173.81,173.81,0,0,0,34.84-104.58C397.44,126.38,319.06,48,222.72,48S48,126.38,48,222.72s78.38,174.72,174.72,174.72A173.81,173.81,0,0,0,327.3,362.6l94.09,94.09a25,25,0,0,0,35.3-35.3ZM97.92,222.72a124.8,124.8,0,1,1,124.8,124.8A124.95,124.95,0,0,1,97.92,222.72Z" fill="currentColor"/></svg><div>Перейти в магазин</div></button></a>
                  <button class="button"><svg height="512px" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" width="512px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="_x31_66_x2C__Heart_x2C__Love_x2C__Like_x2C__Twitter"><g><path d="M365.4,59.628c60.56,0,109.6,49.03,109.6,109.47c0,109.47-109.6,171.8-219.06,281.271    C146.47,340.898,37,278.568,37,169.099c0-60.44,49.04-109.47,109.47-109.47c54.73,0,82.1,27.37,109.47,82.1    C283.3,86.999,310.67,59.628,365.4,59.628z" fill="currentColor"/></g></g><g id="Layer_1"/></svg><div>В избранное</div></button>
                  <button class="button"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title/><path d="M18,21H6a3,3,0,0,1-3-3V6A3,3,0,0,1,6,3h4a1,1,0,0,1,0,2H6A1,1,0,0,0,5,6V18a1,1,0,0,0,1,1H18a1,1,0,0,0,1-1V14a1,1,0,0,1,2,0v4A3,3,0,0,1,18,21Z" fill="currentColor"/><path d="M21,4.05v5a1,1,0,0,1-.62.92.84.84,0,0,1-.38.08,1,1,0,0,1-.71-.29L17.45,8l-4.79,4.79a1,1,0,0,1-1.42,0,1,1,0,0,1,0-1.42L16,6.55,14.24,4.76A1,1,0,0,1,14,3.67,1,1,0,0,1,15,3.05h5a.73.73,0,0,1,.25,0,.37.37,0,0,1,.14,0,.94.94,0,0,1,.53.53.37.37,0,0,1,0,.14A.73.73,0,0,1,21,4.05Z" fill="currentColor"/></svg><div>Поделиться</div></button>
                </div>
                <div class="buttons_mobile">
                  <button class="button"><svg height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg"><title/><path d="M456.69,421.39,362.6,327.3a173.81,173.81,0,0,0,34.84-104.58C397.44,126.38,319.06,48,222.72,48S48,126.38,48,222.72s78.38,174.72,174.72,174.72A173.81,173.81,0,0,0,327.3,362.6l94.09,94.09a25,25,0,0,0,35.3-35.3ZM97.92,222.72a124.8,124.8,0,1,1,124.8,124.8A124.95,124.95,0,0,1,97.92,222.72Z" fill="currentColor"/></svg></button>
                  <button class="button"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title/><path d="M18,21H6a3,3,0,0,1-3-3V6A3,3,0,0,1,6,3h4a1,1,0,0,1,0,2H6A1,1,0,0,0,5,6V18a1,1,0,0,0,1,1H18a1,1,0,0,0,1-1V14a1,1,0,0,1,2,0v4A3,3,0,0,1,18,21Z" fill="currentColor"/><path d="M21,4.05v5a1,1,0,0,1-.62.92.84.84,0,0,1-.38.08,1,1,0,0,1-.71-.29L17.45,8l-4.79,4.79a1,1,0,0,1-1.42,0,1,1,0,0,1,0-1.42L16,6.55,14.24,4.76A1,1,0,0,1,14,3.67,1,1,0,0,1,15,3.05h5a.73.73,0,0,1,.25,0,.37.37,0,0,1,.14,0,.94.94,0,0,1,.53.53.37.37,0,0,1,0,.14A.73.73,0,0,1,21,4.05Z" fill="currentColor"/></svg>
                  </button>
                  <button class="button"><svg height="512px" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" width="512px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="_x31_66_x2C__Heart_x2C__Love_x2C__Like_x2C__Twitter"><g><path d="M365.4,59.628c60.56,0,109.6,49.03,109.6,109.47c0,109.47-109.6,171.8-219.06,281.271    C146.47,340.898,37,278.568,37,169.099c0-60.44,49.04-109.47,109.47-109.47c54.73,0,82.1,27.37,109.47,82.1    C283.3,86.999,310.67,59.628,365.4,59.628z" fill="currentColor"/></g></g><g id="Layer_1"/></svg></button>
                </div>
            </div>
        </div>
      <div class="suggest_product">
        <div class="title_center">Похожие товары</div>

        <div class="product_line">
          @if($gifts->isEmpty())
            <p>Подарков по этому запросу не найдено.</p>
          @endif
          @foreach ($gifts as $gift)
            <div class="featured-products">
                <a href={{ url('/gift/' . $gift->id) }}>
                  <?php
                      $photo_url = str($gift->id);
                      $photo= '/Images/wbshkaa_' . $photo_url . '_1.jpg';
                  ?>
                  
                  <img src="{{ Storage::url($photo) }}" class="product_image" alt={{$gift->name}}>
                  <p class="price">{{$gift->cost}} р</p>
                  <div class="product-name">
                    <p class="product-name2">{{$gift->name}}</p>
                    <p class="sort-description">Stylish cafe chair</p>
                  </div>
                </a>
                <div class="cost"></div>
            </div>
          @endforeach
    </div>
      {{ $gifts->links() }}

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
</script>
@endsection