import numpy as np
import matplotlib.pyplot as plt

class SimplePerceptron:
    def __init__(self, input_size, output_size):
        # Инициализация весов и смещений
        self.W = np.random.randn(input_size, output_size) * 0.01
        self.b = np.zeros(output_size)
    
    def forward(self, X):
        # Прямое распространение
        return np.dot(X, self.W) + self.b
    
    def compute_loss(self, y_pred, y_true):
        # Вычисление MSE
        return np.mean((y_pred - y_true)**2)
    
    def train(self, X, y, epochs=1000, lr=0.01):
        # Градиентный спуск
        losses = []
        n_samples = X.shape[0]
        
        for epoch in range(epochs):
            # Прямой проход
            y_pred = self.forward(X)
            
            # Вычисление ошибки
            loss = self.compute_loss(y_pred, y)
            losses.append(loss)
            
            # Обратное распространение
            error = y_pred - y
            dW = (2/n_samples) * np.dot(X.T, error)
            db = (2/n_samples) * np.sum(error, axis=0)
            
            # Обновление параметров
            self.W -= lr * dW
            self.b -= lr * db
            
            if epoch % 100 == 0:
                print(f'Epoch {epoch}, Loss: {loss:.4f}')
        
        return losses

# Генерация синтетических данных
np.random.seed(42)
n_samples = 1000

# Входные данные (нормализованные)
X = np.random.uniform(-1, 1, (n_samples, 3))

# Истинные параметры модели (для генерации данных)
true_W = np.random.randn(3, 8)
true_b = np.random.randn(8)

# Генерация целевых значений с шумом
y = np.dot(X, true_W) + true_b + np.random.normal(0, 0.1, (n_samples, 8))

# Разделение данных на обучающую и тестовую выборки
train_size = int(0.8 * n_samples)
X_train, X_test = X[:train_size], X[train_size:]
y_train, y_test = y[:train_size], y[train_size:]

# Создание и обучение модели
model = SimplePerceptron(input_size=3, output_size=8)
losses = model.train(X_train, y_train, epochs=1000, lr=0.1)

# Визуализация процесса обучения
plt.plot(losses)
plt.title('Градиентный спуск: уменьшение функции потерь')
plt.xlabel('Эпоха')
plt.ylabel('MSE')
plt.grid(True)
plt.show()

# Оценка на тестовых данных
test_pred = model.forward(X_test)
test_loss = model.compute_loss(test_pred, y_test)
print(f'Test loss: {test_loss:.4f}')
print()