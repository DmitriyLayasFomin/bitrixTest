<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
require_once( $_SERVER['DOCUMENT_ROOT'] . "/local/devCore/classes/IBlockWorker.php" );
if (CModule::IncludeModule('iblock')) { 
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
$arResult = productList();
$this->IncludeComponentTemplate();
}
?>