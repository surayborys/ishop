
<!--filter for products-->
<?php
/**
 * @var $activeCategory contains array with elements, that describe active category 
 */
?>
<?php $filterIncluded = 1;?>    
<div class="col-md-3 product-price">

    <div class=" rsidebar span_1_of_left">
        <div class="of-left">
            <h3 class="cate">Categories</h3>
        </div>
        <br>
        <ul class="acc-menu spec"><!-- class="menu"-->               
            <?php

            function createMenu(array $category, array $activeCategory) {
                if ($category['is_final'] == 1) {
                    echo '<li><a href="/category/' . $activeCategory['title'] . '/' . $category['id'] . '/page-1' .'">' . $category['title'] . '</a></li>';
                    return true;
                }
                echo '<li><a href="/category/' . $activeCategory['title'] . '/' . $category['id'] . '/page-1' .'">' . $category['title'] . '</a>';
                echo '<ul class="spec">';
                foreach ($category['childs'] as $subcategory) {
                    createMenu($subcategory, $activeCategory);
                }
                echo '</ul>';
                echo '</li>';
                return true;
            }
            ?>

              <?php foreach ($activeCategory['childs'] as $subcategory):?>
                <?php createMenu($subcategory, $activeCategory); ?>
              <?php endforeach; ?>
            <!--li><a href="#">Главная</a></li>
            <li><a href="#">Новости</a></li>
            <li><a href="#">Прайс</a></li>
            <li><a href="#">Услуги</a>
                <ul class="spec">
                    <li><a href="#">Услуга 1</a></li>
                    <li><a href="#">Услуга 2</a></li>
                    <li><a href="#">Услуга 3</a>
                        <ul class="spec">
                            <li><a href="#">Услуга 1</a></li>
                            <li><a href="#">Услуга 2</a></li>
                            <li><a href="#">Услуга 3</a></li>
                            <li><a href="#">Услуга 4</a></li>
                            <li><a href="#">Услуга 5</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Услуга 4</a></li>
                    <li><a href="#">Услуга 5</a></li>
                </ul>
            </li>
            <li><a href="#">Контакты</a></li-->
        </ul>
    </div>
    

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