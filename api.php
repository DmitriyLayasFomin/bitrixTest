<?php
ini_set('session.cookie_httponly', 0);
error_reporting(E_ALL);
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';
require_once( $_SERVER['DOCUMENT_ROOT'] . "/local/devCore/classes/Card.php" );
if($_POST['command'] == 'incard'){
      
    $result = null;
    $card = Card::isset($_POST['id']);
    if($card == true){
        $result = Card::remove($_POST['id']);
    }else{
        $result = Card::add($_POST['id']);
    }
    
    echo json_encode($result);
}
?>