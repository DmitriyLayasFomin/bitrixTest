<?
define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true);

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';
if (CModule::IncludeModule('iblock')) { 
require_once( $_SERVER['DOCUMENT_ROOT'] . "/local/devCore/classes/IBlockWorker.php" );
require_once( $_SERVER['DOCUMENT_ROOT'] . "/local/devCore/classes/Product.php" );
// $worker = new IBlockWorker();
// $lol = $worker->getElements();
//$lol = $worker->getField(15,25);
function productList(){
    $worker = new IBlockWorker();
    $result;
    $elements = $worker->getElements();
    foreach ($elements as $element){
        $field = $worker->getField($element["IBLOCK_ID"],$element["ID"]);
        $field['availability'] == "Y" ? $availability = true : $availability = false;
        $result[] = [
            "id" => $element["ID"],
            "name" => $element["NAME"],
            "price" => $field['price'],
            "image" => CFile::GetPath($element["PREVIEW_PICTURE"]),
            "availability" => $availability
        ];
        
    }
    return $result;
}
$lol = productList();
$lol = json_encode($lol);
echo($lol);
}
?>