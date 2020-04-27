<?php


class Card {
    
    public static function add($id){
        
        $_SESSION['card'][$id] = $id;
        $result = true;
        return $result;
    }
    public static function remove($id){
        
        $result = true;
        if(isset($_SESSION['card'])){
            foreach($_SESSION['card'] as $key=>$value){
                
                if($value == $id){
                    
                    unset($_SESSION['card'][$key]);
                    $result = false;
                }
            }
        }else{
            $result = false;
        }
        
        return $result;
    }

    public static function isset($id){
        $result = false;
        if (isset($_SESSION['card'][$id])) {
            $result = true;
        }
        return $result;
    }
}
?>
