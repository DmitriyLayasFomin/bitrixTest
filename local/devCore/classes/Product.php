<?php

class Product {
    protected $id, $name, $price, $image, $availability;

    public function __construct($id = null, $name = null, $price = null, $image = null, $availability = null){
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->image = $image;
        $this->availability = $availability;
    }
    public function toArray(){
        return [
            "id" => $this->id,
            "name" => $this->name,
            "price" => $this->price,
            "image" => $this->image,
            "availability" => $this->availability
        ];
    }
    
}
?>