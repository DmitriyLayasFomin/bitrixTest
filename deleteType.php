<?
define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true);

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';
if (CModule::IncludeModule('iblock')) { 
require_once( $_SERVER['DOCUMENT_ROOT'] . "/local/devCore/classes/IBlockWorker.php" );
require_once( $_SERVER['DOCUMENT_ROOT'] . "/local/devCore/classes/Product.php" );
$worker = new IBlockWorker();
$worker->deleteIBlockType();
}
?>