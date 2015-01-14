<?php
/**
 * Created by PhpStorm.
 * User: Valentina
 * Date: 22.09.14
 * Time: 13:31
 */
//расширения файлов, из которых происходит загрузка неинициализированных классов;
spl_autoload_extensions(".php");
require_once('class/Autoloader.php');
//регистрируем автозагрузчик классов
spl_autoload_register(array('Autoloader', 'loadClasses'));

//подключение функций
require_once 'functions_global.php';
require_once 'functions.php';
require_once 'functions_admin.php';
require_once 'library.php';
require_once 'string.php';
require_once 'functions_catalog.php';