# Установка библиотеки speech_recognition
!pip install SpeechRecognition

# Импорт необходимых библиотек
import speech_recognition as sr
import requests
import json
import logging

# Настройка логирования
logging.basicConfig(level=logging.INFO)

# Функция для отправки POST-запроса с JSON-данными
def send_post_request(url, data=None, json_data=None, headers=None):
    try:
        response = requests.post(url, data=data, json=json_data, headers=headers)
        response.raise_for_status()  # Проверка на ошибки HTTP
        return response.json() if response.headers.get("Content-Type") == "application/json" else response.text
    except requests.exceptions.RequestException as e:
        logging.error(f"Ошибка при отправке запроса: {e}")
        return None

# Распознавание речи
r = sr.Recognizer()

# Проверка доступности микрофона
if not sr.Microphone.list_microphone_names():
    logging.error("Микрофон не найден")
    exit(1)

with sr.Microphone() as source:
    print("Говорить")
    audio = r.listen(source)

try:
    text = r.recognize_google(audio, language="ru-RU")
    print("Распознанный текст: " + text)
    
    # Подготовка данных для отправки на сервер
    url = "http://158.160.15.198/hi"  # Замените на ваш URL
    headers = {'Content-Type': 'application/json'}
    data = {'text': text}  # Данные для отправки в формате JSON
    
    # Отправка данных на сервер
    response = send_post_request(url, json_data=data, headers=headers)
    if response:
        print("Ответ сервера:", response)

except sr.UnknownValueError:
    print("Не понял")
except sr.RequestError as e:
    print("Ошибка; {0}".format(e))