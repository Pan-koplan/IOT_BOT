import time
import numpy as np
import matplotlib.pyplot as plt

# Реализация дуальных чисел
class DualNumber:
    def __init__(self, real, dual=0):
        self.real = real  # Вещественная часть (значение функции)
        self.dual = dual  # Дуальная часть (производная)

    def __add__(self, other):
        if isinstance(other, DualNumber):
            return DualNumber(self.real + other.real, self.dual + other.dual)
        else:
            return DualNumber(self.real + other, self.dual)

    def __mul__(self, other):
        if isinstance(other, DualNumber):
            return DualNumber(self.real * other.real, self.real * other.dual + self.dual * other.real)
        else:
            return DualNumber(self.real * other, self.dual * other)

    def __pow__(self, power):
        return DualNumber(self.real**power, power * self.real**(power - 1) * self.dual)

    def __sub__(self, other):
        if isinstance(other, DualNumber):
            return DualNumber(self.real - other.real, self.dual - other.dual)
        else:
            return DualNumber(self.real - other, self.dual)

    def __truediv__(self, other):
        if isinstance(other, DualNumber):
            return DualNumber(self.real / other.real, (self.dual * other.real - self.real * other.dual) / other.real**2)
        else:
            return DualNumber(self.real / other, self.dual / other)

    def __radd__(self, other):
        return self.__add__(other)

    def __rmul__(self, other):
        return self.__mul__(other)

    def __rsub__(self, other):
        return DualNumber(other - self.real, -self.dual)

    def __rtruediv__(self, other):
        return DualNumber(other / self.real, -other * self.dual / self.real**2)

    def __repr__(self):
        return f"DualNumber(real={self.real}, dual={self.dual})"

# Автоматическое дифференцирование с использованием дуальных чисел
def autodiff(f, x):
    # Преобразуем x в дуальное число: x = x + 1*epsilon
    x_dual = DualNumber(x, 1)
    # Вычисляем f(x + epsilon)
    result = f(x_dual)
    # Возвращаем значение и производную
    return result.real, result.dual
y = 2
c = 1
# Пример функции
def f(x):
    return x**2 + y*x + c

# Параметры градиентного спуска
N = 50    # число итераций
xx = 1    # начальное значение
lmd = 0.07  # шаг сходимости

# Данные для построения графика функции
x_plt = np.arange(-5.0, 5.0, 0.1)
f_plt = [f(x) for x in x_plt]

# Создание окна и осей для графика
fig, ax = plt.subplots()
ax.grid(True)  # отображение сетки на графике

# Отображение графика функции
ax.plot(x_plt, f_plt)
point = ax.scatter(xx, f(xx), c='red', label="Текущая точка")  # Начальная точка

# Градиентный спуск
for i in range(N):
    # Вычисляем значение функции и её производную в точке xx
    f_x, df_x = autodiff(f, xx)
    # Обновляем xx с использованием градиента
    xx = xx - lmd * df_x

    # Обновление положения точки на графике
    point.set_offsets([xx, f(xx)])

    # Перерисовка графика и задержка
    plt.pause(0.1)

# Отображение конечной точки
ax.scatter(xx, f(xx), c='blue', label="Конечная точка")
ax.legend()  # Добавление легенды

# Вывод результата
print(f"Минимум функции достигается в точке x = {xx:.4f}, f(x) = {f(xx):.4f}")

# Отображение графика
plt.show()