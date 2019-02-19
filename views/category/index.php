<?php
/**
 * @var array $localSettings - stores local settings of the project
 * @var array $products - stores products
 */
include_once $this->localSettings['pathToHeader'];
?>

<div class="product">
    <div class="container">
        <!--LEFT MENU (FILTER)-->
        <?php include_once $this->localSettings['pathToFilter']; ?>
        <!--/LEFT MENU (FILTER)-->
        <!--PRODUCTS-->
        <div class="col-md-9 product1">

            <?php foreach ($products as $row): ?>
                <div class=" bottom-product">
                    <?php foreach ($row as $product_item): ?>
                        <div class="col-md-4 bottom-cd simpleCart_shelfItem">
                            <div class="product-at ">
                                <a href="/product/<?= $product_item['id'] ?>"><img class="img-responsive" src="/<?=$product_item['image']?>" alt="">
                                    <div class="pro-grid">
                                        <span class="buy-in">Buy Now</span>
                                    </div>
                                </a>	
                            </div>
                            <p class="tun"><?= $product_item['title'] ?></p>
                            <a href="#" class="item_add"><p class="number item_price"><i> </i>$ <?= $product_item['price'] ?></p></a>						
                        </div>
                    <?php endforeach; ?>
                    <div class="clearfix"> </div>
                </div>
            <?php endforeach; ?>

        </div>
        <div class="clearfix"> </div>
        <nav class="in">
            <ul class="pagination">
                <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                <li><a href="#">2 <span class="sr-only"></span></a></li>
                <li><a href="#">3 <span class="sr-only"></span></a></li>
                <li><a href="#">4 <span class="sr-only"></span></a></li>
                <li><a href="#">5 <span class="sr-only"></span></a></li>
                <li> <a href="#" aria-label="Next"><span aria-hidden="true">»</span> </a> </li>
            </ul>
        </nav>
        <!--/PRODUCTS-->
    </div>


    <?php include_once $this->localSettings['pathToFooter']; ?>
