# Symfony-final-project

Установка:
1. composer install
2. yarn install
3. yarn run dev
4. php bin/console doctrine:database:create
5. php bin/console doctrine:migrations:migrate
6. php bin/console doctrine:fixtures:load

Основные разделы:
Главная - /homepage
Каталог - /catalog
Категория товара - /catalog/category/{id}
Карточка товара - /catalog/details/{id}
Войти - /login
Выйти - /logout
Регистрация - /register
Восстановить пароль - /reset-password
Личный кабинет - /personal
Профиль - /personal/profile

Статические:
Скидки - /promo
Контакты - /contacts
О нас - /about-us
Сравнение - /compare
Корзина - /cart
История заказов - /personal/orders
История просмотров - /personal/view-history

