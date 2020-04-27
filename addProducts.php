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
$products[0]= new Product(null, "АКРИЛОВАЯ ВАННА РАДОМИР VANESSA", 5500, "https://www.gidromarket.ru/f/product/radomir_vanessa_moderna_levaya.jpg", true);
$products[1]= new Product(null, "АКРИЛОВАЯ ВАННА RIHO CAROLINA", 7000, "https://www.gidromarket.ru/f/product/big_riho_carolina_170_80.jpg", false);
$products[3]= new Product(null, "АКРИЛОВАЯ ВАННА ТРИТОН СКАРЛЕТ", 30000, "https://www.gidromarket.ru/f/product/big_triton_skarlett.jpg", true);
$products[4]= new Product(null, "УГЛОВАЯ ВАННА ТРИТОН", 3000, "https://www.gidromarket.ru/f/product/big_triton_liliya_548.jpg", true);
$products[5]= new Product(null, "АКРИЛОВАЯ ВАННА ТРИТОН СТАНДАРТ", 8000, "https://www.gidromarket.ru/f/product/big_200034597_400006_pryamougolnaya_vanna_triton_standart_140.jpg", false);
$products[6]= new Product(null, "АКРИЛОВАЯ ВАННА RIHO", 2000, "https://www.gidromarket.ru/f/product/big_300010219_379928_akrilovaya_vanna_riho_julia_160.jpg", false);
$products[7]= new Product(null, "АКРИЛОВАЯ ВАННА RIHO CAROLINA", 6600, "https://www.gidromarket.ru/f/product/big_300010251_378934_akrilovaya_vanna_riho_carolina_180.jpg", true);
$products[8]= new Product(null, "АКРИЛОВАЯ ВАННА RIHO NEO", 7000, "https://www.gidromarket.ru/f/product/big_300010272_381511_akrilovaya_vanna_riho_neo_150.jpg", true);
$products[9]= new Product(null, "АКРИЛОВАЯ ВАННА АКВАТЕК", 10000, "https://www.gidromarket.ru/f/product/big_akvatek_alfa_966.jpg", true);
foreach ($products as $product){
    $id = $worker->addElement($block, $product->toArray(), $iblockType);
    var_dump($id);
}

}
?>