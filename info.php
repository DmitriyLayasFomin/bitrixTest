<?php
// require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';
// use Bitrix\Main\Application;
// use Bitrix\Main\Context;
session_id($_COOKIE['sessionId']); 
session_start();
//$_SESSION['ok'] = 'lol';
echo ($_SESSION['ok']); 
phpinfo();
