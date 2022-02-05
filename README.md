# Obalor TestWork

1. Клонируем этот репозиторий в папку на сервере
```
git clone https://github.com/Atmden/ObalorTestWork
```

2. Переходим в папку. Устанавливаем Laravel и необходимые пакеты
```
cd ObalorTestWork
```
```
composer install
```

3. Настраиваем подключение к базе данных
```
cp .env.example .env
```
Радктируем `.env` - указываем наименование базы данных и логин/пароль.

4. Выполняем миграцию и первоначальное заполнение базы.
```
php artisan migrate --seed
```

5. Запускаем консольную команду для импорта CSV файла (файл должен находится в папке public/random.csv)
```
php artisan import:customers
```
