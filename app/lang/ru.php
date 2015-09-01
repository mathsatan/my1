<?php
// LABELS
define ('L_SITE_TITLE', 'mathsatan');
define ('L_TITLE', 'MVC сайт');

    // left menu
define ('L_MENU', 'Основное меню');
define ('L_MAIN', 'Главная');
define ('L_ARTICLES', 'Статьи по категориям');
define ('L_ABOUT', 'Об организации');
    // categories
define ('L_ART', 'Искусство');
define ('L_MATH', 'Математика');
define ('L_PROG', 'Программирование');
define ('L_NO_ARTICLES_FOUND', 'Не найдено статей по данной категории');

    // sign in & sign out
define ('L_LOGIN', 'Войти');
define ('L_OUT', 'Выйти');
define ('L_REG', 'Регистрация');
define ('L_HELLO', 'Привет');
define ('L_REG_PAGE', 'Страница регистрации');
define ('L_LOGIN_PAGE', 'Страница авторизации');
define ('L_USER_LOGIN', 'Логин');
define ('L_USER_PASS', 'Пароль');
define ('L_USER_MAIL', 'Почта');
define ('L_SUBMIT', 'Отправить');

    // news
define ('L_NEWS', 'Новости');

    // error page
define ('L_ERROR', 'Ошибка');

    // admin
define ('L_ADMIN_PANEL', 'Админ панель');
define ('L_USER_LIST', 'Список пользователей');
define ('L_ADD_USER', 'Добавить пользователя');
define ('L_USER_ID', 'Идентификатор');
define ('L_USER_STATUS', 'Статус');
define ('L_USER_IS_ACTIVE', 'Активен');
define ('L_USER_UPDATE', 'Обновить пользователя');
define ('L_USER_DELETE', 'Удалить пользователя');
// admin.articles
define ('L_ARTICLES_LIST', 'Список статей');
define ('L_ADD_ARTICLE', 'Добавить статью');
define ('L_ARTICLE_ID', 'ID статьи');
define ('L_ARTICLE_TITLE', 'Титул статьи');
define ('L_ARTICLE_BRIEFLY', 'Кратко');
define ('L_ARTICLE_UPDATE', 'Изменить статью');
define ('L_ARTICLE_DELETE', 'Удалить статью');

// admin menu
define ('L_ADMIN_MENU', 'Админ меню');
define ('L_USER_MANAGEMENT', 'Управление пользователями');
define ('L_ARTICLES_MANAGEMENT', 'Управление статьями');
define ('L_USER_OTHER', 'Дополнительно');

// articles
define ('L_NO_COMMENTS', 'Нет комментариев');
define ('L_COMMENTS', 'Комментарии:');
define ('L_YOUR_COMMENT', 'Ваш комментарий');
define ('L_ARTICLE_AUTHOR', 'Автор статьи');
define ('L_ARTICLE_TEXT', 'Текст статьи');
define ('L_ARTICLE_CAT', 'Категория');

// INFO
define ('I_LOGIN_SUCCESS', 'Авторизация прошла успешно');
define ('I_REG_SUCCESS', 'Регистрация прошла успешно');
// admin
define ('I_UPDATE_SUCCESS', 'Обновление прошло успешно');
define ('I_DELETE_SUCCESS', 'Удаление прошло успешно');
define ('I_INSERT_SUCCESS', 'Добавление прошло успешно');

// ERRORS & EXCEPTIONS
define ('E_EMPTY_FIELD', 'Пустые поля!');
define ('E_USER_NOT_FOUND', 'Такого пользователя нет!');
define ('E_WRONG_LOGIN_OR_PASS', 'Неверный логин/пароль!');
define ('E_LOGIN_ALREADY_EXIST', 'Такой логин уже есть!');
define ('E_INVALID_EMAIL', 'Неверный почтовый адрес!');
define ('E_NOT_ALLOWED', 'Недостаточно прав!');
define ('E_FAIL_GET_ARTICLES', 'Ошибка извлечения статей!');
define ('E_MODEL_FILE_DOESNT_EXIST', 'Файл модели не найден!');
define ('E_CONTROLLER_FILE_DOESNT_EXIST', 'Файл контроллера не найден!');
define ('E_INCORRECT_ACTION', 'Неверное действие!');
define ('E_INCORRECT_PARAMS', 'Неверные параметры!');

define ('E_WRONG_ID', 'Неверный формат id');
define ('E_NO_ARTICLE_DATA', 'Отсутствуют данные статьи');
define ('E_INCORRECT_DATA', 'Неверные данные');
// admin
define ('E_UPDATE_FAIL', 'Ошибка обновления');
define ('E_DELETE_FAIL', 'Ошибка удаления');
define ('E_INSERT_FAIL', 'Ошибка добавления');
// admin.articles
define ('E_ARTICLES_NOT_FOUND', 'Статей не найдено');