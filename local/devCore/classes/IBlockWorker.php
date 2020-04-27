<?php

require_once( __DIR__."/Product.php" );
class IBlockWorker {
    public $blockType, $block, $property, $element;
    private $type = "catalog";
    private $infoblockName = "Товары";
    public function __construct(){
        $this->blockType = new CIBlockType();
        $this->block = new CIBlock();
        $this->property = new CIBlockProperty();
        $this->element = new CIBlockElement();
    }
    public function addInfoBlockType($ruName, $enName){
        $ciBlock = CIBlockType::GetByID($this->type);
        $ar_res = $ciBlock->GetNext();
        if ($ar_res['ID'] == null) {

            $arFields = [
                'ID' => $this->type,
                'LANG' => [
                    'en' => [
                        'NAME' => $enName,
                    ],
                    'ru' => [
                        'NAME' => $ruName,
                    ]
                ]
            ];
            $ID = $this->blockType->Add($arFields);
        } else {
            $ID = $ar_res['ID'];
        }
        return $ID;
    }
    public function deleteIBlockType(){
        $blockArray = $this->getBlocksByCode($this->translit($this->infoblockName));

        $result = [];
        $resultTemp = [];
        $el = null;
        foreach ($blockArray as $block) {
            $el = CIBlockElement::GetList(['iblock_id' => $block["ID"]], ['IBLOCK_CODE' => $block['CODE'], 'ACTIVE' => 'Y', 'NAME' => "%{$search}%"]);

            while ($ob = $el->GetNextElement()) {
                $resultTemp = $ob->GetFields();
                CIBlock::Delete($resultTemp[0]['BLOCK_ID']);
                array_push($resultTemp, $ob->GetFields());
                //$resultTemp[] = $ob->GetFields();
            }
        }
        
        CIBlockType::Delete($this->type);
    }
    public function addInfoBlock($infoblockName = null, $iblockType = null, $imageUrl = null){
        if($imageUrl != null){
            $arFile = $this->saveImage($imageUrl);
            $image = CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"] . '/upload/' . $arFile["SUBDIR"] . '/' . $arFile["FILE_NAME"]);
        }else{
            $image = null;
        }
        $arFields = [
            "ACTIVE" => "Y",
            "NAME" => $this->infoblockName,
            "CODE" => $this->translit($this->infoblockName),
            "IBLOCK_TYPE_ID" => $this->type,
            "PICTURE" => $image,
            "SITE_ID" => "s1",
        ];
        $id = $this->block->Add($arFields);
        return $id;
    }
    public function addElement($iblockId, $product, $iblockType){
        if($product['image'] != null){
            $arFile = $this->saveImage($product['image']);
            $image = CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"] . '/upload/' . $arFile["SUBDIR"] . '/' . $arFile["FILE_NAME"]);
        }else{
            $image = null;
        }
        $active;
        $product['availability'] == true ? $active = "Y" : $active = "N";
        $arr = [
            "IBLOCK_ID" => $iblockId,
            "NAME" => $product["name"],
            "CODE" => $this->translit($product["name"]),
            "DETAIL_TEXT" => $product["description"],
            "ACTIVE" => "Y",
            "PREVIEW_PICTURE" => $image,
            "DETAIL_PICTURE" => $image,
            "PROPERTY_VALUES" => [
                "price" => $product["price"],
                "availability" => $active
            ]
        ];
        $ID = $this->element->Add($arr);
        CIBlock::SetPermission($ID, Array("1"=>"X", "2"=>"R"));
        return $id;
    }
    public function addField($name, $code, $type, $id, $default = 1)
    {
        $arFields = [
            "NAME" => $name,
            "ACTIVE" => "Y",
            "SORT" => "100",
            "CODE" => $code,
            "PROPERTY_TYPE" => $type,
            "IS_REQUIRED" => "Y",
            "IBLOCK_ID" => $id,
            "DEFAULT_VALUE" => $default,
            "FILTRABLE" => "Y"
        ];
        $PropID = $this->property->Add($arFields);

        return $PropID;
    }
    public static function getField($blockId, $elementId)
    {
        $arr = [];
        $prop = CIBlockElement::GetProperty($blockId, $elementId);
        while ($ob = $prop->GetNext()) {
            $arr[$ob['CODE']] = $ob['VALUE'];
        }
        return $arr;
    }
    public function saveImage($imageUrl){
        $image = file_get_contents($imageUrl);
        $path_parts = pathinfo($imageUrl);
        $arIMAGE = [
            "name" => str_replace('-', '', $path_parts['filename']) . '.' . $path_parts['extension'],
            "content" => $image
        ];
        $fid = CFile::SaveFile($arIMAGE, "Images");
        $rsFile = CFile::GetByID($fid);
        $arFile = $rsFile->Fetch();
        return $arFile;
    }

    protected function translit($s)
    {
        $s = (string)$s;
        $s = trim($s);
        $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s); // переводим строку в нижний регистр (иногда надо задать локаль)
        $s = strtr($s, array(' ' => '_', 'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'e', 'ж' => 'j', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'shch', 'ы' => 'y', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya', 'ъ' => '', 'ь' => ''));
        return $s;
    }

    public function getElements($code = '', $search = '')
    {
        $blockArray = $this->getBlocksByCode($this->translit($this->infoblockName));
        $result = [];
        $resultTemp = [];
        $el;
        foreach ($blockArray as $block) {
            $el = CIBlockElement::GetList(['iblock_id' => $block["ID"]], ['IBLOCK_CODE' => $block['CODE'], 'ACTIVE' => 'Y', 'NAME' => "%{$search}%"]);
            
            while ($ob = $el->GetNextElement()) {
                $resultTemp[] = $ob->GetFields();
            }
        }

        $result = $resultTemp;
        return $result;
    }

    public function getBlocksByCode($code = '')
    {
        $res = CIBlock::GetList(['iblock_type' => $this->type], ['CODE' => $code]);

        $arr = [];

        while ($ar_res = $res->GetNext()) {

            $arr[] = $ar_res;
        }
        return $arr;
    }


}

?>