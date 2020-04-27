<?
define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
require_once( $_SERVER['DOCUMENT_ROOT'] . "/local/devCore/classes/IBlockWorker.php" );
require_once( $_SERVER['DOCUMENT_ROOT'] . "/local/devCore/classes/Product.php" );
// $APPLICATION->SetTitle("Мебельная компания");
 $APPLICATION->IncludeComponent("dm:productList",".default",[],false);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>