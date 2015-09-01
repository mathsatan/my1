<?php
require_once 'core/model.php';
require_once 'core/view.php';
require_once 'core/controller.php';
require_once 'core/route.php';
require_once 'core/mvcexception.php';

try
{
    Route::start(); // запускаем маршрутизатор
}
catch (MVCException $e) {
    Route::ErrorPage($e->getMessage());
}
catch (PDOException $e2) {
    Route::ErrorPage($e2->getMessage());
}
catch (TemplateException $e3) {
    Route::ErrorPage($e3->getMessage());
}
