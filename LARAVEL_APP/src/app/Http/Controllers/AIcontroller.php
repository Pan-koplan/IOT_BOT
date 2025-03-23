<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AIcontroller extends Controller
{
    public function TagGen(Request $descript_prompt){
        //dd(env('FOLDERID'), env('OAUTHTOKEN'));
        $validator = Validator::make($descript_prompt->all(), [
            'descript_prompt' => 'required|min:10'
        ], [
            'descript_prompt.required' => 'Поле "Описание" обязательно для заполнения.',
            'descript_prompt.min' => 'Поле "Описание" должно содержать минимум 10 символов.',
        ]);
        // Очищаем данные от лишних пустых строк
        $cleanedData = array_map('trim', $descript_prompt->all());
        if ($validator->fails()) {
            return back()
                ->withErrors($validator) // Ошибки валидации
                ->withInput($cleanedData) // Старые данные формы
                ->with([
                    'custom_message', 'Пожалуйста, исправьте ошибки в форме',
                ]);
            }
        
        //dd($descript_prompt->input('descript_prompt'));
        // Данные запроса
        $prompt = [
            "modelUri" => "gpt://".env("FOLDERID")."/yandexgpt",
            "completionOptions" => [
                "stream" => false,
                "temperature" => 0.6,
                "maxTokens" => "2000"
            ],
            "messages" => [
                [
                    "role" => "system",
                    "text" => "К описанию человека подбери теги из списка ниже, эти теги описывают свойства подарка, который наилучшим образом подойдет этому человеку. подбери как можно больше тегов, сохраняя адекватность и не придумывая новых, пример вывода:Дом и быт#Красота и уход#Электроника#Развлечения. Далее описан список тегов, выбирай только из них: Дом и быт Красота и уход Электроника Развлечения Спорт и активный отдых Еда и напитки Мода и стиль Книги Здоровье Декор и интерьер Аксессуары Подарки для мужчин Подарки для женщин Подарки для детей Профессиональные подарки Техника и инструменты Парфюмерия Аксессуары для дома Спорттовары Игры и хобби Товары для животных Товары для офиса Милое Деловой стиль Практичный Смешное Релаксация Оздоровление Инновационное Функциональное Красивое Полезное Саморазвитие Технологичное Эстетичное Гурманский Удобное Комфортное Незабываемое Памятное Вдохновляющее Развлекательное Обучающее Для пожилых Для коллег Для друзей Для партнеров Релаксация Красота Здоровье Удобство Комфорт Вдохновение Развлечения Обучение Уход Забота Практичность Стиль Экологичность Безопасность Качество Долговечность Прочность Уникальность Памятность Уборка Уход за волосами Наборы DIY Гадание Баня Соленое Кухня Косметика Строительный инструмент Timekiller Рыбалка Сладкое Уход за кожей Защитные чехлы Программист Походы Полезная еда Туризм Водитель Вышивание Дизайнер Рисование Фотография Коллекционирование Ролевые игры Аксессуары для компьютера Строитель Украшения Мебель Фитнес"
                ],
                [
                    "role" => "user",
                    "text" => $descript_prompt->input('descript_prompt')
                ]
            ]
        ];

        // URL для запроса
        $url = "https://llm.api.cloud.yandex.net/foundationModels/v1/completion";

        // Заголовки
        $headers = [
            "Content-Type:application/json",
            "Authorization: Api-Key ".env('OAUTHTOKEN')
        ];

        // Инициализация cURL
        $ch = curl_init($url);

        // Установка параметров cURL
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($prompt));

        // Выполнение запроса
        $response = curl_exec($ch);

        // Обработка ошибок
        if (curl_errno($ch)) {
            dd(curl_error($ch));
        }
        if ($response === FALSE) {
            die('Ошибка при выполнении запроса');
        }
        
        // Закрытие cURL
        curl_close($ch);
        $responseData = json_decode($response, true);
        $responseData = explode('#', $responseData['result']['alternatives'][0]['message']['text']);
        session(['user_request' => $responseData]);
        return redirect()->route("search");
    }
}
?>