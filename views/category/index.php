<?php
/**
 * @var array $localSettings - stores local settings of the project
 * @var array $products - stores products
 */
include_once $this->localSettings['pathToHeader'];
?>
<?php
/**
 * @var array $brands
 * @var array $mainCategories
 */
/* echo '<pre>';
  print_r($activeCategory);
  echo '<hr>';
  echo '</pre>'; */
?>

<div class="product">
    <div class="container">
         <!--LEFT MENU (FILTER)-->
        <div class="col-md-3 product-price">

            <div class=" rsidebar span_1_of_left">
                <div class="of-left">
                    <h3 class="cate">Categories</h3>
                </div>
                <ul class="menu">
                    <?php foreach ($activeCategory['childs'] as $subcategory): ?>
                        <li class="item1"><a href="#"><?= $subcategory['title'] ?></a>
                            <ul class="cute">
                                <?php if (isset($subcategory['childs'])): ?>
                                    <?php foreach ($subcategory['childs'] as $child): ?>
                                        <li class="subitem1"><a href="single.html"><?= $child['title'] ?></a></li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endforeach; ?> 
                </ul>
            </div>
            <!--initiate accordion-->
            <script type="text/javascript">
                $(function () {
                    var menu_ul = $('.menu > li > ul'),
                            menu_a = $('.menu > li > a');
                    menu_ul.hide();
                    menu_a.click(function (e) {
                        e.preventDefault();
                        if (!$(this).hasClass('active')) {
                            menu_a.removeClass('active');
                            menu_ul.filter(':visible').slideUp('normal');
                            $(this).addClass('active').next().stop(true, true).slideDown('normal');
                        } else {
                            $(this).removeClass('active');
                            $(this).next().stop(true, true).slideUp('normal');
                        }
                    });

                });
            </script>
            <!---->

            <div class="sellers">
                <div class="of-left-in">
                    <h3 class="tag">Filter</h3>
                </div>

                <div>
                    <form>
                        <br>
                        <fieldset>
                            <legend>Sort by price</legend>
                            <div>
                                <input type="radio" name="sort_order" id="sort_ord1" checked="1">
                                <label for="sort_ord1">from cheap...</label>
                            </div>
                            <div><input type="radio" name="sort_order" id="sort_ord2">
                                <label for="sort_ord2">from expensive...</label></div>                            
                        </fieldset>
                        <br>
                        <fieldset>
                            <legend>Choose your brands</legend>
                            <?php foreach ($brands as $brand): ?>
                                <div>
                                    <input type="checkbox" id="<?= $brand[id] ?>" name="brands[]" value="<?= $brand['title'] ?>">
                                    <label for="coding"><?= $brand['title'] ?></label>
                                </div>
                            <?php endforeach; ?>
                            <div>
                                <a href="#">clear your choise</a>
                            </div>
                        </fieldset>
                        <br>
                        <fieldset>
                            <legend>Additional</legend>
                            <div>
                                <input type="checkbox" id="new" name="additional[]" value="1">
                                <label for="new">New Arrivals</label>
                            </div>
                            <div>
                                <input type="checkbox" id="top_sales" name="additional[]" value="1">
                                <label for="music">Top sales</label>
                                <div>
                                    <a href="#">clear your choise</a>
                                </div>
                            </div>
                        </fieldset>

                    </form>
                </div>

            </div>

            
        </div>
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
