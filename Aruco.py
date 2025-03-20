import cv2
import numpy as np

# Инициализация захвата видео
cap = cv2.VideoCapture(0)

if not cap.isOpened():
    print("Error: Could not open webcam.")
    exit()

# Инициализация словаря для ARUCO маркеров
aruco_dict = cv2.aruco.getPredefinedDictionary(cv2.aruco.DICT_6X6_250)

# Чтение кадров из веб-камеры
while True:
    ret, frame = cap.read()  # Считываем кадр
    if not ret:
        print("Error: Failed to capture frame.")
        break

    # Преобразуем кадр в оттенки серого для детектора
    gray_frame = cv2.cvtColor(src=frame, code=cv2.COLOR_BGR2GRAY)

    # Детектируем маркеры
    corners, ids, rejected = cv2.aruco.detectMarkers(frame, aruco_dict)

    # Если маркеры найдены, рисуем рамки и ID
    if len(corners) > 0:
        frame = cv2.aruco.drawDetectedMarkers(frame, corners, ids)

        # Дополнительно рисуем рамки и текст вокруг маркеров
        for corner in corners:
            top_left, top_right, bottom_right, bottom_left = corner[0]
            # Рисуем рамку вокруг маркера
            cv2.polylines(frame, [np.int32(corner)], isClosed=True, color=(0, 255, 0), thickness=2)
            # Рисуем текстовый ID маркера
            font = cv2.FONT_HERSHEY_SIMPLEX
            cv2.putText(frame, f"ID: {ids[0]}",
                        (int(top_left[0]), int(top_left[1]) - 10),
                        font, 0.5, (0, 255, 0), 2, cv2.LINE_AA)

    # Отображаем кадр
    cv2.imshow('Webcam Feed', frame)

    # Выход по нажатию клавиши 'q'
    if cv2.waitKey(1) & 0xFF == ord('q'):
        break

# Закрываем захват и окна
cap.release()
cv2.destroyAllWindows()
