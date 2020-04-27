
<div class="container px-sm-0">
    <div class="row d-flex justify-content-sm-center">
        <?
        if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
        require_once( $_SERVER['DOCUMENT_ROOT'] . "/local/devCore/classes/Card.php" );
        
        ?>
            <?php foreach($arResult as $product): ?>
                <?php
                $availability = ['text'=>'', 'value'=>true];
                $incard = ['text'=>'В корзину', 'value'=>''];
                $card = Card::isset($product['id']);
                $product['availability'] == true ? $availability = ['text'=>'Есть', 'value'=>'true'] : $availability = ['text'=>'Нет', 'value'=>'false'];
                $card == false ? $incard = ['text'=>'В корзину', 'value'=>''] : $incard = ['text'=>'Убрать', 'value'=>'incard'];
                
                ?>

                <div class="wrapper col-12 col-sm-7 col-md-6 col-lg-4 px-4">
                <div class="product px-2 pb-3 pb-md-2 mb-2">
                    <div class="w-100 h-90 px-3 px-sm-0 px-md-2">
                        <a href="#" ><div style="background-image: url(<?=$product['image']?>);" class="image mb-2"></div></a>
                        <a href="#" class="name"><?=$product['name']?></a>
                        <p class="availability <?=$availability['value']?>"><?=$availability['text'] ?> в наличии</p>
                    </div>
                    <div class="d-flex justify-content-between px-3 px-sm-0 px-md-2 flex-wrap">
                        <p class="price"><?=$product['price']?> р.</p>
                        <button dataid="<?=$product['id']?>" class="<?= $incard['value'] ?> card mr-4 py-auto text-center"><?= $incard['text'] ?></button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
    </div>
</div>