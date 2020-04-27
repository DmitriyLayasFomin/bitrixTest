<?
define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true);

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';
if (CModule::IncludeModule('iblock')) { 
require_once( $_SERVER['DOCUMENT_ROOT'] . "/local/devCore/classes/IBlockWorker.php" );
require_once( $_SERVER['DOCUMENT_ROOT'] . "/local/devCore/classes/Product.php" );
$worker = new IBlockWorker();
$type = $worker->addInfoBlockType('Каталог', 'catalog');
var_dump($type);
$block = $worker->addInfoBlock();
$fields = $worker->addField("цена", "price", "N", $block);
$fields = $worker->addField("наличие на складе", "availability", "Y/N", $block, "Y");
var_dump($block);
$products = [];
$products[0]= new Product(null, "Маска синия", 55, "https://img2.wbstatic.net/large/new/11870000/11877344-1.jpg", true);
$products[1]= new Product(null, "Маска черная", 70, "https://img2.wbstatic.net/large/new/11870000/11877344-1.jpg", false);
$products[2]= new Product(null, "Маска белая", 30, "https://img2.wbstatic.net/large/new/11870000/11877344-1.jpg", true);
foreach ($products as $product){
    $id = $worker->addElement($block, $product->toArray(), $iblockType);
    var_dump($id);
}

}
?>